<?php

namespace HelgeSverre\Snov\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProspectManagement extends BaseResource
{
    /**
     * Add prospect to a specific list.
     *  This method will be useful for those who want to automate adding prospects to lists with active email drip campaigns.
     *  This way after a prospect is automatically added to a chosen list, an email drip campaign will be started for them automatically.
     */
    public function addProspectToList(
        $email,
        $fullName,
        $firstName,
        $lastName,
        $phones,
        $country,
        $locality,
        $position,
        $companyName,
        $companySite,
        $updateContact,
        $customFields,
        $socialLinks,
        $listId,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\AddProspectToListRequest(
            email: $email,
            fullName: $fullName,
            firstName: $firstName,
            lastName: $lastName,
            phones: $phones,
            country: $country,
            locality: $locality,
            position: $position,
            companyName: $companyName,
            companySite: $companySite,
            updateContact: $updateContact,
            customFields: $customFields,
            socialLinks: $socialLinks,
            listId: $listId,
        ));
    }

    /**
     * Find prospects from your lists by id.
     *  Knowing the id of a specific prospect you can get full information on the prospect, including the lists and campaigns they’ve been added to.
     */
    public function findProspectByID(
        $id,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\FindProspectByIDRequest(
            id: $id,
        ));
    }

    /**
     * Find prospect from your lists by email address.
     *  When you search by email, you receive a list of all prospects tied to this email address.
     *  Every element of the list contains full information on the prospect, including the lists and campaigns they’ve been added to.
     */
    public function findProspectByEmail(
        $email,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\FindProspectByEmailRequest(
            email: $email,
        ));
    }

    /**
     * This method returns a list of all custom fields created by the user, including the fields’ name, whether the field is optional or required, and the field’s data type.
     */
    public function findProspectsCustomFields(
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\FindProspectsCustomFieldsRequest(
        ));
    }

    /**
     * This method returns all lists created by the user.
     *  You can use this method to review lists that can be used for an email drip campaign.
     */
    public function seeUserLists(
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\SeeUserListsRequest(
        ));
    }

    /**
     * This method returns all the data on prospects in a specific list, including prospect’s data like email addresses and their status.
     */
    public function viewProspectsInList(
        $listId,
        $page,
        $perPage,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\ViewProspectsInListRequest(
            listId: $listId,
            page: $page,
            perPage: $perPage,
        ));
    }

    /**
     * Use this method to create new prospect lists in your account.
     */
    public function createNewProspectList(
        $name,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\ProspectManagement\CreateNewProspectListRequest(
            name: $name,
        ));
    }
}
