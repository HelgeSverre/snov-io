<?php

namespace HelgeSverre\Snov;

use HelgeSverre\Snov\Resources\DripCampaigns;
use HelgeSverre\Snov\Resources\EmailFinder;
use HelgeSverre\Snov\Resources\EmailVerifier;
use HelgeSverre\Snov\Resources\ProspectManagement;
use HelgeSverre\Snov\Resources\UserAccount;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\HasTimeout;
use SensitiveParameter;

class Snov extends Connector
{
    use AcceptsJson;
    use HasTimeout;

    public function __construct(
        #[SensitiveParameter] protected readonly string $clientId,
        #[SensitiveParameter] protected readonly string $clientSecret,
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.snov.io';
    }

    public function dripCampaigns(): DripCampaigns
    {
        return new DripCampaigns($this);
    }

    public function emailFinder(): EmailFinder
    {
        return new EmailFinder($this);
    }

    public function emailVerifier(): EmailVerifier
    {
        return new EmailVerifier($this);
    }

    public function prospectManagement(): ProspectManagement
    {
        return new ProspectManagement($this);
    }

    public function userAccount(): UserAccount
    {
        return new UserAccount($this);
    }
}
