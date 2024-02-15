<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CheckLinkClicksRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    /**
     * @var mixed Unique identifier of the campaign you want to view link clicks for.
     **/
    public function __construct(
        protected mixed $campaignId
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-emails-clicked';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
