<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ViewSentEmailsRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    /**
     * @var mixed Unique identifier of the campaign for which you want to see sent emails.
     **/
    public function __construct(
        protected mixed $campaignId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/emails-sent';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'campaignId' => $this->campaignId,
        ]);
    }
}
