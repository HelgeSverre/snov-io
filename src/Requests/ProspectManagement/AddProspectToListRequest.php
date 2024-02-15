<?php

namespace HelgeSverre\Snov\Requests\ProspectManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddProspectToListRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  mixed  $email  The prospect’s email address.
     * @param  mixed  $fullName  The prospect’s full name.
     * @param  mixed  $firstName  The prospect’s first name.
     * @param  mixed  $lastName  The prospect’s last name.
     * @param  mixed  $phones  Array with prospect's phone numbers.
     * @param  mixed  $country  The prospect’s country. The country names are defined here. Please, only use countries from this list.
     * @param  mixed  $locality  The prospect’s locality.
     * @param  mixed  $position  The prospect’s job title.
     * @param  mixed  $companyName  The name of the prospect’s company.
     * @param  mixed  $companySite  The prospect’s company website. Please, use the http://example.com format.
     * @param  mixed  $updateContact  Updates an existing prospect. Can contain true , or false . If true and a prospect with this email address already exists in one of the lists, the system will update the existing profile. If false , the system will not update the existing profile.
     * @param  mixed  $customFields  You can add custom values into previously created custom fields. To do this specify the name of the custom field in the [brackets].
     * @param  mixed  $socialLinks  A link to the prospect’s social media profile. Specify the name of the social network in the [brackets] (LinkedIn, Facebook, or X).
     * @param  mixed  $listId  The identifier of the list the prospect belongs to.
     **/
    public function __construct(
        protected mixed $email,
        protected mixed $fullName,
        protected mixed $firstName,
        protected mixed $lastName,
        protected mixed $phones,
        protected mixed $country,
        protected mixed $locality,
        protected mixed $position,
        protected mixed $companyName,
        protected mixed $companySite,
        protected mixed $updateContact,
        protected mixed $customFields,
        protected mixed $socialLinks,
        protected mixed $listId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/add-prospect-to-list';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'email' => $this->email,
            'fullName' => $this->fullName,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phones' => $this->phones,
            'country' => $this->country,
            'locality' => $this->locality,
            'position' => $this->position,
            'companyName' => $this->companyName,
            'companySite' => $this->companySite,
            'updateContact' => $this->updateContact,
            'customFields[specialization]' => $this->customFields[specialization],
            'socialLinks[linkedIn]' => $this->socialLinks[linkedIn],
            'listId' => $this->listId,
        ]);
    }
}
