<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\UserAccount\CheckUserBalanceRequest;
use Saloon\Http\BaseResource;

class UserAccount extends BaseResource
{
    /**
     * Use this method to check your credit balance.
     */
    public function checkUserBalance(): Response
    {
        return $this->connector->send(new CheckUserBalanceRequest());
    }
}
