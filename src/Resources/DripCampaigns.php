<?php

namespace HelgeSverre\Snov\Resources;

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
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\ChangeRecipientsStatusRequest(
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
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\SeeListOfCompletedProspectsRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method returns the campaign replies with all the information, including the prospect’s name, ID, campaign, etc.
     */
    public function seeCampaignReplies(
        $campaignId,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\SeeCampaignRepliesRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method shows the information about the opened emails in the campaign.
     */
    public function getInfoAboutCampaignOpens(
        $campaignId,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\GetInfoAboutCampaignOpensRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method returns information on all campaign recipients that have clicked a link in one of campaign emails.
     */
    public function checkLinkClicks(
        $campaignId,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\CheckLinkClicksRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method shows the information about sent emails in the campaign.
     */
    public function viewSentEmails(
        $campaignId,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\ViewSentEmailsRequest(
            campaignId: $campaignId,
        ));
    }

    /**
     * This method shows the list of all user campaigns.
     */
    public function viewAllCampaigns(
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\ViewAllCampaignsRequest(
        ));
    }

    /**
     * Using this method you can add an email or a domain to your Do-not-email List.
     *  After this email/domain has been added to the list, you won't be able to send emails to it.
     */
    public function addToDoNotEmailList(
        $items,
        $listId,
    ): Response {
        return $this->connector->send(new \HelgeSverre\Snov\Requests\DripCampaigns\AddToDoNotEmailListRequest(
            items: $items,
            listId: $listId,
        ));
    }
}
