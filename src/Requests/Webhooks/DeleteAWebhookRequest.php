<?php

namespace HelgeSverre\Snov\Requests\Webhooks;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DeleteAWebhookRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::DELETE;

    public function __construct()
    {
    }

    public function resolveEndpoint(): string
    {
        return '/v2/webhooks/webhook_id';
    }
}
