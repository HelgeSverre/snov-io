<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SeeCampaignRepliesRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  mixed  $campaignId  Unique identifier of the campaign you want to view replies from.
     **/
    public function __construct(
        protected mixed $campaignId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-emails-replies';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
