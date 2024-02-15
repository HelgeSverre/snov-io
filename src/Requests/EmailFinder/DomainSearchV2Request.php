<?php

namespace HelgeSverre\Snov\Requests\EmailFinder;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class DomainSearchV2Request extends Request
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    /**
     * @var mixed The name of the domain from which you want to find the email addresses. For example, "snov.io".
     * @var mixed It can contain different values - all ,personal or generic . A generic email address is a role-based email address, for example -contact@snov.io.A personal email address is the email of the actual person working at the company.
     * @var mixed Set the limit to specify the number of email addresses to return. Each response returns up to 100 email addresses.
     * @var mixed To collect more emails than is set in your Limit input parameter, in your next request indicate the id of the last collected email address from the previous request. This way, previously collected emails will be skipped.Note that lastId is a required parameter.The default value is 0 .
     * @var mixed Use this parameter to filter prospects by job position, for example, "Software Developer". To filter by multiple positions, input an array of neccessary positions.
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

    public function defaultBody(): array
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
