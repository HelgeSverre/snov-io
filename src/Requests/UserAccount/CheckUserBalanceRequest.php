<?php

namespace HelgeSverre\Snov\Requests\UserAccount;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CheckUserBalanceRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct()
    {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-balance';
    }

    public function defaultBody(): array
    {
        return array_filter([
        ]);
    }
}
