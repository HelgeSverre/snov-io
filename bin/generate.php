<?php

require './vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

function extractAllApiDocumentation(string $htmlContent): array
{
    $crawler = new Crawler($htmlContent);
    $apiEndpoints = [];

    // Select all paragraph-wrapper blocks
    $crawler->filter('#APIMethods ~ .paragraph-wrapper')->each(function (Crawler $node) use (&$apiEndpoints) {
        $endpoint = [
            'id' => '',
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
            $name = $node->filter('td div.color-one')->count() ? trim($node->filter('td div.color-one')->text()) : 'N/A';
            $description = $node->filter('td:nth-child(2)')->count() ? trim($node->filter('td:nth-child(2)')->text()) : 'N/A';

            return ['name' => $name, 'description' => $description];
        });

        // Extract output parameters
        $outputParametersElements = $node->filter('.table.code.no-margin-bottom tbody tr');
        $endpoint['outputParameters'] = $outputParametersElements->each(function (Crawler $node) {
            $name = $node->filter('td div.color-one')->count() ? trim($node->filter('td div.color-one')->text()) : 'N/A';
            $description = $node->filter('td:nth-child(2)')->count() ? trim($node->filter('td:nth-child(2)')->text()) : 'N/A';

            return ['name' => $name, 'description' => $description];
        });

        $apiEndpoints[] = $endpoint;
        echo "\033[103m\033[30m".str_pad($endpoint['method'], 6, ' ', STR_PAD_BOTH)."\033[0m".'  '."\033[34m".$endpoint['endpoint']."\033[0m"."\n";
    });

    return $apiEndpoints;
}

$filepath = 'api.json';

$html = file_get_contents('https://snov.io/api');
$spec = extractAllApiDocumentation($html);

$json = json_encode($spec, JSON_PRETTY_PRINT);

file_put_contents($filepath, $json);
