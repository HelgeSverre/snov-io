<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SeeListOfCompletedProspectsRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    /**
     * @var mixed Сampaign's unique identifier to retrieve the prospects list.
     **/
    public function __construct(
        protected mixed $campaignId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/prospect-finished';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
