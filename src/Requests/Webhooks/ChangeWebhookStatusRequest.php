<?php

namespace HelgeSverre\Snov\Requests\Webhooks;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ChangeWebhookStatusRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  mixed  $status  active or deactivated
     **/
    public function __construct(
        protected mixed $status,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v2/webhooks/webhook_id';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'status' => $this->status,
        ]);
    }
}
