<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddToDoNotEmailListRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  mixed  $items  Email or domain you want to add to your Do-not-email List.
     * @param  mixed  $listId  The Do-not-email List identifier that emails and domains belong to.
     **/
    public function __construct(
        protected mixed $items,
        protected mixed $listId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/do-not-email-list';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'items' => $this->items,
            'listId' => $this->listId,
        ]);
    }
}
