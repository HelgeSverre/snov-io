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
    public function changeRecipientsStatus(array $data): Response
    {
        return $this->connector->send(new ChangeRecipientsStatusRequest(...$data));
    }

    /**
     * This method returns prospects for whom the campaign has been completed.
     */
    public function seeListOfCompletedProspects(array $data): Response
    {
        return $this->connector->send(new SeeListOfCompletedProspectsRequest(...$data));
    }

    /**
     * This method returns the campaign replies with all the information, including the prospect’s name, ID, campaign, etc.
     */
    public function seeCampaignReplies(array $data): Response
    {
        return $this->connector->send(new SeeCampaignRepliesRequest(...$data));
    }

    /**
     * This method shows the information about the opened emails in the campaign.
     */
    public function getInfoAboutCampaignOpens(array $data): Response
    {
        return $this->connector->send(new GetInfoAboutCampaignOpensRequest(...$data));
    }

    /**
     * This method returns information on all campaign recipients that have clicked a link in one of campaign emails.
     */
    public function checkLinkClicks(array $data): Response
    {
        return $this->connector->send(new CheckLinkClicksRequest(...$data));
    }

    /**
     * This method shows the information about sent emails in the campaign.
     */
    public function viewSentEmails(array $data): Response
    {
        return $this->connector->send(new ViewSentEmailsRequest(...$data));
    }

    /**
     * This method shows the list of all user campaigns.
     */
    public function viewAllCampaigns(array $data): Response
    {
        return $this->connector->send(new ViewAllCampaignsRequest(...$data));
    }

    /**
     * Using this method you can add an email or a domain to your Do-not-email List. After this email/domain has been added to the list, you won't be able to send emails to it.
     */
    public function addToDoNotEmailList(array $data): Response
    {
        return $this->connector->send(new AddToDoNotEmailListRequest(...$data));
    }
}
