<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\ProspectManagement\AddProspectToListRequest;
use HelgeSverre\Snov\Requests\ProspectManagement\CreateNewProspectListRequest;
use HelgeSverre\Snov\Requests\ProspectManagement\FindProspectByEmailRequest;
use HelgeSverre\Snov\Requests\ProspectManagement\FindProspectByIDRequest;
use HelgeSverre\Snov\Requests\ProspectManagement\FindProspectsCustomFieldsRequest;
use HelgeSverre\Snov\Requests\ProspectManagement\SeeUserListsRequest;
use HelgeSverre\Snov\Requests\ProspectManagement\ViewProspectsInListRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProspectManagement extends BaseResource
{
    /**
     * Add prospect to a specific list. This method will be useful for those who want to automate adding prospects to lists with active email drip campaigns. This way after a prospect is automatically added to a chosen list, an email drip campaign will be started for them automatically.
     */
    public function addProspectToList(array $data): Response
    {
        return $this->connector->send(new AddProspectToListRequest(...$data));
    }

    /**
     * Find prospects from your lists by id. Knowing the id of a specific prospect you can get full information on the prospect, including the lists and campaigns they’ve been added to.
     */
    public function findProspectByID(array $data): Response
    {
        return $this->connector->send(new FindProspectByIDRequest(...$data));
    }

    /**
     * Find prospect from your lists by email address. When you search by email, you receive a list of all prospects tied to this email address. Every element of the list contains full information on the prospect, including the lists and campaigns they’ve been added to.
     */
    public function findProspectByEmail(array $data): Response
    {
        return $this->connector->send(new FindProspectByEmailRequest(...$data));
    }

    /**
     * This method returns a list of all custom fields created by the user, including the fields’ name, whether the field is optional or required, and the field’s data type.
     */
    public function findProspectsCustomFields(array $data): Response
    {
        return $this->connector->send(new FindProspectsCustomFieldsRequest(...$data));
    }

    /**
     * This method returns all lists created by the user. You can use this method to review lists that can be used for an email drip campaign.
     */
    public function seeUserLists(array $data): Response
    {
        return $this->connector->send(new SeeUserListsRequest(...$data));
    }

    /**
     * This method returns all the data on prospects in a specific list, including prospect’s data like email addresses and their status.
     */
    public function viewProspectsInList(array $data): Response
    {
        return $this->connector->send(new ViewProspectsInListRequest(...$data));
    }

    /**
     * Use this method to create new prospect lists in your account.
     */
    public function createNewProspectList(array $data): Response
    {
        return $this->connector->send(new CreateNewProspectListRequest(...$data));
    }
}
