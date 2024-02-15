<?php

namespace HelgeSverre\Snov\Requests\EmailFinder;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetProfileWithEmailRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @var mixed The email address of the person you want to find additional information on.
     **/
    public function __construct(
        protected mixed $email
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-profile-by-email';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'email' => $this->email,
        ]);
    }
}
