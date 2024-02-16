<?php

namespace HelgeSverre\Snov\Requests\ProspectManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class FindProspectByIDRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  mixed  $id  The prospect’s id. You can see it in the response when you add a prospect via Add prospect to list API method or in the URL when you view prospect’s page (see an example).
     **/
    public function __construct(
        protected mixed $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-prospect-by-id';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'id' => $this->id,
        ]);
    }
}
