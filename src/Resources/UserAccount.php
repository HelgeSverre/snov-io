<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\UserAccount\CheckUserBalanceRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class UserAccount extends BaseResource
{
    /**
     * Use this method to check your credit balance.
     */
    public function checkUserBalance(array $data): Response
    {
        return $this->connector->send(new CheckUserBalanceRequest(...$data));
    }
}
