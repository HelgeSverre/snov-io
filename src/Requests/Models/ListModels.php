<?php

namespace HelgeSverre\Snov\Requests\Models;

use HelgeSverre\Snov\Dto\Models\ModelList;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * listModels
 *
 * List Available Models
 */
class ListModels extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/models';
    }

    public function createDtoFromResponse(Response $response): ModelList
    {
        return ModelList::from($response->json());
    }
}
