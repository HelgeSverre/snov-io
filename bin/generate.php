<?php

require './vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

function extractApiGroups(string $htmlContent): array
{
    $crawler = new Crawler($htmlContent);
    $apiGroups = [];

    // Extract groups from the sidebar
    $crawler->filter('aside#api-mobile-switcher ul > li.has-ul')->each(function (Crawler $node) use (&$apiGroups) {
        $groupName = trim($node->filter('p')->text());
        $apiGroups[] = [];

        // Extract endpoints within the group
        $node->filter('ul.nested li a')->each(function (Crawler $childNode) use (&$apiGroups, $groupName) {
            $apiGroups[] = [
                'id' => trim($childNode->attr('href'), '#'),
                'group' => $groupName,
            ];
        });
    });

    return $apiGroups;
}

function extractAllApiDocumentation(string $htmlContent, $groups): array
{
    $crawler = new Crawler($htmlContent);
    $apiEndpoints = [];

    // Select all paragraph-wrapper blocks
    $crawler->filter('#APIMethods ~ .paragraph-wrapper')->each(function (Crawler $node) use ($groups, &$apiEndpoints) {
        $endpoint = [
            'id' => '',
            'group' => 'Misc',
            'title' => '',
            'method' => '',
            'description' => '',
            'endpoint' => '',
            'inputParameters' => [],
            'outputParameters' => [],
        ];

        // Extract the title and method
        $titleElement = $node->filter('.title-h5');
        $endpoint['id'] = $node->attr('id');

        $endpoint['group'] = collect($groups)->firstWhere('id', $endpoint['id'])['group'] ?? 'N/A';

        if ($titleElement->count()) {
            $endpoint['title'] = $titleElement->innerText();
            $endpoint['method'] = $titleElement->filter('span')->text();
        }

        // Extract the endpoint
        $endpointElement = $node->filter('.code.dark tbody tr td a');
        if ($endpointElement->count()) {
            $endpoint['endpoint'] = $endpointElement->innerText();
        }

        // Extract descriptions
        $descriptionElements = $node->filter('.description');
        if ($descriptionElements->count()) {
            $descriptions = $descriptionElements->each(function (Crawler $node) {
                return trim($node->text());
            });
            $endpoint['description'] = implode(' ', $descriptions);
        }

        // Extract input parameters
        $inputParametersElements = $node->filter('.title-h5:contains("Input parameters") + .table.code tbody tr');
        $endpoint['inputParameters'] = $inputParametersElements->each(function (Crawler $node) {
            $name = $node->filter('td div.color-one')->count() ? trim($node->filter('td div.color-one')->text()) : null;
            $description = $node->filter('td:nth-child(2)')->count() ? trim($node->filter('td:nth-child(2)')->text()) : null;

            if (! $name) {
                return null;
            }

            return ['name' => $name, 'description' => $description];
        });

        // Extract output parameters
        $outputParametersElements = $node->filter('.table.code.no-margin-bottom tbody tr');
        $endpoint['outputParameters'] = $outputParametersElements->each(function (Crawler $node) {
            $name = $node->filter('td div.color-one')->count() ? trim($node->filter('td div.color-one')->text()) : null;
            $description = $node->filter('td:nth-child(2)')->count() ? trim($node->filter('td:nth-child(2)')->text()) : null;

            if (! $name) {
                return null;
            }

            return ['name' => $name, 'description' => $description];
        });

        $endpoint['inputParameters'] = array_filter($endpoint['inputParameters']);
        $endpoint['outputParameters'] = array_filter($endpoint['outputParameters']);

        $apiEndpoints[] = $endpoint;
    });

    return $apiEndpoints;
}

$filepath = 'api.json';

$html = file_get_contents('https://snov.io/api');

$groups = extractApiGroups($html);
$apiDocumentation = extractAllApiDocumentation($html, $groups);

$json = json_encode($apiDocumentation, JSON_PRETTY_PRINT);

file_put_contents($filepath, $json);
