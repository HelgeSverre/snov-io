<?php

namespace HelgeSverre\Snov\Requests\ProspectManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class FindProspectsCustomFieldsRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct(
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/prospect-custom-fields';
    }

    public function defaultBody(): array
    {
        return array_filter([
        ]);
    }
}
