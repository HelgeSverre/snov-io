<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\DripCampaigns\AddToDoNotEmailListRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\ChangeRecipientsStatusRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\CheckLinkClicksRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\GetInfoAboutCampaignOpensRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\SeeCampaignRepliesRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\SeeListOfCompletedProspectsRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\ViewAllCampaignsRequest;
use HelgeSverre\Snov\Requests\DripCampaigns\ViewSentEmailsRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class DripCampaigns extends BaseResource
{
    /**
     * Change the status of a recipient in a specific campaign.
     */
    public function changeRecipientsStatus(
        $email,
        $campaignId,
        $status,
    ): Response {
        return $this->connector->send(new ChangeRecipientsStatusRequest(
            email: $email,
            campaignId: $campaignId,
            status: $status,
        ));
    }

    /**
     * This method returns prospects for whom the campaign has been completed.
     */
    public function seeListOfCompletedProspects(
        $campaignId,
    ): Response {
        return $this->connector->send(new SeeListOfCompletedProspectsRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method returns the campaign replies with all the information, including the
     * prospect’s name, ID, campaign, etc.
     */
    public function seeCampaignReplies(
        $campaignId,
    ): Response {
        return $this->connector->send(new SeeCampaignRepliesRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method shows the information about the opened emails in the campaign.
     */
    public function getInfoAboutCampaignOpens(
        $campaignId,
    ): Response {
        return $this->connector->send(new GetInfoAboutCampaignOpensRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method returns information on all campaign recipients that have clicked a
     * link in one of campaign emails.
     */
    public function checkLinkClicks(
        $campaignId,
    ): Response {
        return $this->connector->send(new CheckLinkClicksRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method shows the information about sent emails in the campaign.
     */
    public function viewSentEmails(
        $campaignId,
    ): Response {
        return $this->connector->send(new ViewSentEmailsRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method shows the list of all user campaigns.
     */
    public function viewAllCampaigns(): Response
    {
        return $this->connector->send(new ViewAllCampaignsRequest());
    }

    /**
     * Using this method you can add an email or a domain to your Do-not-email List.
     * After this email/domain has been added to the list, you won't be able to send
     * emails to it.
     */
    public function addToDoNotEmailList(
        $items,
        $listId,
    ): Response {
        return $this->connector->send(new AddToDoNotEmailListRequest(
            items: $items,
            listId: $listId,
        ));
    }
}
