<?php

namespace HelgeSverre\Snov\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class UserAccount extends BaseResource
{
    /**
     * Use this method to check your credit balance.
     */
    public function checkUserBalance(
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\UserAccount\CheckUserBalanceRequest(
        ));
    }
}
