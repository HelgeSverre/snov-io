<?php

namespace HelgeSverre\Snov\Resources;

use HelgeSverre\Snov\Requests\Webhooks\AddWebhookRequest;
use HelgeSverre\Snov\Requests\Webhooks\ChangeWebhookStatusRequest;
use HelgeSverre\Snov\Requests\Webhooks\DeleteAWebhookRequest;
use HelgeSverre\Snov\Requests\Webhooks\ListAllWebhooksRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Webhooks extends BaseResource
{
    /**
     * This API method allows you to get a list of webhooks on your account. The
     * response returns a collection of webhook models. The properties of the model are
     * listed below:
     */
    public function listAllWebhooks(): Response
    {
        return $this->connector->send(new ListAllWebhooksRequest());
    }

    /**
     * This API method allows you to create a webhook subscription and receive event
     * notifications to the specified endpoint URL. The response returns a model of the
     * added webhook. The properties of the model are listed below:
     */
    public function addWebhook(
        $eventObject,
        $eventAction,
        $endpointUrl,
    ): Response {
        return $this->connector->send(new AddWebhookRequest(
            eventObject: $eventObject,
            eventAction: $eventAction,
            endpointUrl: $endpointUrl,
        ));
    }

    /**
     * Changes the status of a chosen webhook subscription. Include the unique “id”
     * value of the chosen webhook at the end of the request URL address. Use List all
     * webhooks method to get id values of your webhooks. The response returns a model
     * of the added webhook. The properties of the model are listed below:
     */
    public function changeWebhookStatus(
        $status,
    ): Response {
        return $this->connector->send(new ChangeWebhookStatusRequest(
            status: $status,
        ));
    }

    /**
     * Deletes a chosen webhook. Include the unique “id” value of the chosen
     * webhook at the end of the request URL address. Use List all webhooks method to
     * get id values of your webhooks. The response returns a collection of webhook
     * models. The properties of the model are listed below:
     */
    public function deleteAWebhook(): Response
    {
        return $this->connector->send(new DeleteAWebhookRequest());
    }
}
