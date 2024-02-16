<?php

namespace HelgeSverre\Snov\Requests\Webhooks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListAllWebhooksRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct()
    {
    }

    public function resolveEndpoint(): string
    {
        return '/v2/webhooks';
    }
}
