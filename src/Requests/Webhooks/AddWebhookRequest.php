<?php

namespace HelgeSverre\Snov\Requests\Webhooks;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddWebhookRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  mixed  $eventObject  the object the action is performed on (list of supported objects)
     * @param  mixed  $eventAction  the action performed on the object (list of supported actions)
     * @param  mixed  $endpointUrl  the URL address where the webhook is sent
     **/
    public function __construct(
        protected mixed $eventObject,
        protected mixed $eventAction,
        protected mixed $endpointUrl,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v2/webhooks';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'event_object' => $this->eventObject,
            'event_action' => $this->eventAction,
            'endpoint_url' => $this->endpointUrl,
        ]);
    }
}
