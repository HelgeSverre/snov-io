<?php

namespace HelgeSverre\Snov\Requests\ProspectManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class FindProspectByEmailRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @var mixed The prospect’s email address.
     **/
    public function __construct(
        protected mixed $email
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-prospects-by-email';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'email' => $this->email,
        ]);
    }
}
