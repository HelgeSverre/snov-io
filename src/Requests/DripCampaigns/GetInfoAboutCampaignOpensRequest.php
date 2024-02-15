<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetInfoAboutCampaignOpensRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  mixed  $campaignId  Unique identifier of the campaign for which you want to view information about email opens.
     **/
    public function __construct(
        protected mixed $campaignId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-emails-opened';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
