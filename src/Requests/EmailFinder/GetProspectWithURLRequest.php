<?php

namespace HelgeSverre\Snov\Requests\EmailFinder;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetProspectWithURLRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @var mixed A link to the prospect’s social media profile. Specify the name of the social network in the [brackets] (LinkedIn or X).
     **/
    public function __construct(
        protected mixed $url,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-emails-from-url';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'url' => $this->url,
        ]);
    }
}
