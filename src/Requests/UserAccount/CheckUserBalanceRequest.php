<?php

namespace HelgeSverre\Snov\Requests\UserAccount;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class CheckUserBalanceRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct()
    {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/get-balance';
    }
}
