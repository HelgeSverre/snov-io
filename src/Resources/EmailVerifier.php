<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\EmailVerifier\AddEmailsForVerificationRequest;
use HelgeSverre\Snov\Requests\EmailVerifier\EmailVerifierRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class EmailVerifier extends BaseResource
{
    /**
     * Check if the provided email addresses are valid and deliverable. API endpoint will return the email verification results. If we haven’t verified a certain email address before, the results will not be returned to you. In this case, the API will return a “not_verified” identifier and you will not be charged credits for this email. You should use the Add emails for verification method to push this email address for verification, after which you will be able to get the email verification results using this endpoint. This method will return data for each requested email address. The response contains an email verification status and verification results.
     */
    public function emailVerifier(array $data): Response
    {
        return $this->connector->send(new EmailVerifierRequest(...$data));
    }

    /**
     * If you've never verified a certain email address before, you should push it for verification using this API method. After performing this action, you can receive the verification results using the Email Verifier.
     */
    public function addEmailsForVerification(array $data): Response
    {
        return $this->connector->send(new AddEmailsForVerificationRequest(...$data));
    }
}
