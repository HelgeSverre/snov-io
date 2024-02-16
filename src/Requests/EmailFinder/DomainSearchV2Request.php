<?php

namespace HelgeSverre\Snov\Requests\EmailFinder;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DomainSearchV2Request extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  mixed  $domain  The name of the domain from which you want to find the email addresses. For example, "snov.io".
     * @param  mixed  $type  It can contain different values - all ,personal or generic . A generic email address is a role-based email address, for example -contact@snov.io.A personal email address is the email of the actual person working at the company.
     * @param  mixed  $limit  Set the limit to specify the number of email addresses to return. Each response returns up to 100 email addresses.
     * @param  mixed  $lastId  To collect more emails than is set in your Limit input parameter, in your next request indicate the id of the last collected email address from the previous request. This way, previously collected emails will be skipped.Note that lastId is a required parameter.The default value is 0 .
     * @param  mixed  $positions  Use this parameter to filter prospects by job position, for example, "Software Developer". To filter by multiple positions, input an array of neccessary positions.
     **/
    public function __construct(
        protected mixed $domain,
        protected mixed $type,
        protected mixed $limit,
        protected mixed $lastId,
        protected mixed $positions,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v2/domain-emails-with-info';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'type' => $this->type,
            'limit' => $this->limit,
            'lastId' => $this->lastId,
            'positions' => $this->positions,
        ]);
    }
}
