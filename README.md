<p align="center"><img src="./art/header.png"></p>

# Laravel Client for Snov.io

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helgesverre/snov-io.svg?style=flat-square)](https://packagist.org/packages/helgesverre/snov-io)
[![Total Downloads](https://img.shields.io/packagist/dt/helgesverre/snov-io.svg?style=flat-square)](https://packagist.org/packages/helgesverre/snov-io)

The Snov.io Laravel Client enables laravel applications to interact with the [Snov.io API](https://snov.io/api).

## Installation

You can install the package via composer:

```bash
composer require helgesverre/snov-io
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="snov-io"
```

This is the contents of the published config file:

```php
return [
    'client_id' => env('SNOV_CLIENT_ID'),
    'client_secret' => env('SNOV_CLIENT_SECRET'),
];
```

## Usage

### Creating an authenticated client

```php
use HelgeSverre\Snov\Snov;

// Instantiate the client
$snov = new Snov(
    clientId: config('snov-io.client_id'),
    clientSecret: config('snov-io.client_secret'),
);

// Authenticate the client
$snov->authenticate($snov->getAccessToken());

// Call the API with a request
$snov->send(new EmailCountRequest(
    domain: "snov.io",
));
```

Creating an authenticated client is only necessary if you want to use the client to send individual requests manually,
if you use the resource methods on the Snov class, the client will be authenticated automatically.

```php
$snov = new Snov(
    clientId: config('snov-io.client_id'),
    clientSecret: config('snov-io.client_secret'),
);

// No need to authenticate the client, the resource method will do it automatically
$snov->emailFinder()->emailCount(
    domain: "snov.io",
);
```

### Using the Facade

You can also use the Facade to access the Snov.io API.

```php
Snov::dripCampaigns();
Snov::emailFinder();
Snov::emailVerifier();
Snov::prospectManagement();
Snov::userAccount();
```

### Resource: Drip Campaigns

```php
Snov::dripCampaigns()->changeRecipientsStatus($email, $campaignId, $status);
Snov::dripCampaigns()->seeListOfCompletedProspects($campaignId);
Snov::dripCampaigns()->seeCampaignReplies($campaignId);
Snov::dripCampaigns()->getInfoAboutCampaignOpens($campaignId);
Snov::dripCampaigns()->checkLinkClicks($campaignId);
Snov::dripCampaigns()->viewSentEmails($campaignId);
Snov::dripCampaigns()->addToDoNotEmailList($items, $listId);
```

### Resource: Email Finder

```php
Snov::emailFinder()->domainSearchV2($domain, $type, $limit, $lastId, $positions);
Snov::emailFinder()->emailCount($domain);
Snov::emailFinder()->emailFinder($firstName, $lastName, $domain);
Snov::emailFinder()->addNamesToFindEmails($firstName, $lastName, $domain);
Snov::emailFinder()->addURLToSearchForProspect($url);
Snov::emailFinder()->getProspectWithURL($url);
Snov::emailFinder()->getProfileWithEmail($email);
```

### Resource: Email Verifier

```php
Snov::emailVerifier()->emailVerifier($emails)
Snov::emailVerifier()->addEmailsForVerification($emails)
```

### Resource: Prospect Management

```php

Snov::prospectManagement()->addProspectToList(
    $email,
    $fullName,
    $firstName,
    $lastName,
    $phones,
    $country,
    $locality,
    $position,
    $companyName,
    $companySite,
    $updateContact,
    $customFields,
    $socialLinks,
    $listId,
);
Snov::prospectManagement()->findProspectByID($id);
Snov::prospectManagement()->findProspectByEmail($email);
Snov::prospectManagement()->viewProspectsInList($listId, $page, $perPage);
Snov::prospectManagement()->createNewProspectList($name);
```

### Resource: Prospect Management

```php
Snov::userAccount()->checkUserBalance();
```

### Resource: Webhooks

```php
Snov::webhooks()->listAllWebhooks();
Snov::webhooks()->addWebhook($eventObject, $eventAction, $endpointUrl,);
Snov::webhooks()->changeWebhookStatus($status,);
Snov::webhooks()->deleteAWebhook();
```

## Development

Snov.io does not have an API specification publicly available, however their API docs are fairly structured and can be
scraped to generate something resembling an API spec that can be used to auto-generate parts of this SDK.

### Resource: Code generation

Run code generation with the composer script `codegen` using this command:

```shell
composer codegen 
```

Which runs these tasks:

```shell
# Generate the API spec
php ./bin/generate.php

# Generate the Resource and Request classes from the API spec
php ./bin/codegen.php

# Format the generated code
composer format 
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

