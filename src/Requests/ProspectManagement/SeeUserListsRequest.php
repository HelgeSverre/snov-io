<?php

namespace HelgeSverre\Snov\Requests\ProspectManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SeeUserListsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-user-lists';
    }
}
