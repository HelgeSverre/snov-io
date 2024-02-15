<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\EmailFinder\AddNamesToFindEmailsRequest;
use HelgeSverre\Snov\Requests\EmailFinder\AddURLToSearchForProspectRequest;
use HelgeSverre\Snov\Requests\EmailFinder\DomainSearchV2Request;
use HelgeSverre\Snov\Requests\EmailFinder\EmailCountRequest;
use HelgeSverre\Snov\Requests\EmailFinder\EmailFinderRequest;
use HelgeSverre\Snov\Requests\EmailFinder\GetProfileWithEmailRequest;
use HelgeSverre\Snov\Requests\EmailFinder\GetProspectWithURLRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class EmailFinder extends BaseResource
{
    /**
     * Enter a domain name and Snov.io will return all the email addresses on the
     * domain.If there is any additional information about the email owner available in
     * the database, we will add it as well.Each response returns up to 100 emails. If
     * it does not return at least one email, you will not be charged for the request.
     */
    public function domainSearchV2(
        $domain,
        $type,
        $limit,
        $lastId,
        $positions,
    ): Response {
        return $this->connector->send(new DomainSearchV2Request(
            domain: $domain,
            type: $type,
            limit: $limit,
            lastId: $lastId,
            positions: $positions,
        ));
    }

    /**
     * With this API method, you can find out the number of email addresses from a
     * certain domain in our database. It`s completely free, so you don`t need credits
     * to use it!
     */
    public function emailCount(
        $domain,
    ): Response {
        return $this->connector->send(new EmailCountRequest(
            domain: $domain,
        ));
    }

    /**
     * This API method finds email addresses using the person`s first and last name,
     * and a domain name. If we don`t have this email address in our database, we won`t
     * be able to provide the results to you right away. To speed up the process, you
     * can use the Add Names To Find Emails method to push this email address for
     * search. After that, try the Email Finder method again.
     */
    public function emailFinder(
        $firstName,
        $lastName,
        $domain,
    ): Response {
        return $this->connector->send(new EmailFinderRequest(
            firstName: $firstName,
            lastName: $lastName,
            domain: $domain,
        ));
    }

    /**
     * If Snov.io does not have the emails you are looking for in its database and
     * can't provide these email addresses via the Email Finder, you can try to push
     * the request for email search using this method. If an email is found, you can
     * collect it by using the free Email Finder request again.
     */
    public function addNamesToFindEmails(
        $firstName,
        $lastName,
        $domain,
    ): Response {
        return $this->connector->send(new AddNamesToFindEmailsRequest(
            firstName: $firstName,
            lastName: $lastName,
            domain: $domain,
        ));
    }

    /**
     * Find prospects by social URL. To receive the results, use the Get prospect with
     * URL method.
     */
    public function addURLToSearchForProspect(
        $url,
    ): Response {
        return $this->connector->send(new AddURLToSearchForProspectRequest(
            url: $url,
        ));
    }

    /**
     * Provide the prospect's social URL and Snov.io will return the full information
     * on the prospect with the found email addresses. You should previously use the
     * Add URL to search for prospect method. Otherwise, the result will not be shown.
     */
    public function getProspectWithURL(
        $url,
    ): Response {
        return $this->connector->send(new GetProspectWithURLRequest(
            url: $url,
        ));
    }

    /**
     * Provide an email address and Snov.io will return all the profile information
     * connected to the provided email address owner from the database.If we find no
     * information about the email owner in our database, you will not be charged for
     * the request.
     */
    public function getProfileWithEmail(
        $email,
    ): Response {
        return $this->connector->send(new GetProfileWithEmailRequest(
            email: $email,
        ));
    }
}
