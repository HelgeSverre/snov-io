<?php

namespace HelgeSverre\Snov\Requests\DripCampaigns;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ChangeRecipientsStatusRequest extends Request
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  mixed  $email  The prospect’s email address.
     * @param  mixed  $campaignId  The campaign’s id. You can find it in the URL when you view the campaign info (show an example).
     * @param  mixed  $status  New status for the recipient. Can contain Active, Paused, Finished, Unsubscribed, Auto-replied, Replied, Replied from another email. You can not change the recipients' status if their status is Finished or Moved.
     **/
    public function __construct(
        protected mixed $email,
        protected mixed $campaignId,
        protected mixed $status,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/change-recipient-status';
    }

    public function defaultBody(): array
    {
        return array_filter([
            'email' => $this->email,
            'campaign_id' => $this->campaignId,
            'status' => $this->status,
        ]);
    }
}
