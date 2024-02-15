<?php

namespace HelgeSverre\Snov\Requests\EmailFinder;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class EmailCountRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  mixed  $domain  The name of the domain for which you`d like to know the number of emails in our database.
     **/
    public function __construct(
        protected mixed $domain,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-domain-emails-count';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
        ]);
    }
}
