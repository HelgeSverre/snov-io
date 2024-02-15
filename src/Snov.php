<?php

namespace HelgeSverre\Snov;

use HelgeSverre\Snov\Resource\Chat;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\HasTimeout;
use SensitiveParameter;

class Snov extends Connector
{
    use AcceptsJson;
    use HasTimeout;

    public function __construct(
        #[SensitiveParameter] protected readonly string $clientId,
        #[SensitiveParameter] protected readonly string $clientSecret,
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl ?: 'https://api.mistral.ai/v1';
    }

    public function chat(): Chat
    {
        return new Chat($this);
    }

    public function simpleChat(): SimpleChat
    {
        return new SimpleChat($this);
    }

    public function embedding(): Embedding
    {
        return new Embedding($this);
    }

    public function models(): Models
    {
        return new Models($this);
    }
}
