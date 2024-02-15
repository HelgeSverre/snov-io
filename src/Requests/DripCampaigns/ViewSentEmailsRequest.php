<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ViewSentEmailsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  mixed  $campaignId  Unique identifier of the campaign for which you want to see sent emails.
     **/
    public function __construct(
        protected mixed $campaignId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/emails-sent';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
