<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SeeListOfCompletedProspectsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  mixed  $campaignId  Сampaign's unique identifier to retrieve the prospects list.
     **/
    public function __construct(
        protected mixed $campaignId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/prospect-finished';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
