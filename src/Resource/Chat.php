<?php

namespace HelgeSverre\Snov\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Chat extends BaseResource
{

    public function create(
        array $messages,
    ): Response
    {
        return $this->connector->send(new CreateChatCompletion(
            new ChatCompletionRequest(
                model: $model,
                messages: $messages,
                temperature: $temperature,
                topP: $topP,
                maxTokens: $maxTokens,
                stream: $stream,
                safeMode: $safeMode,
                randomSeed: $randomSeed,
            )
        ));
    }
}
