<?php

namespace Permafrost\Api;

use Illuminate\Http\JsonResponse;
use Permafrost\Api\JsonApiHelper;

class JsonApiResponse extends JsonResponse
{
    use JsonApiHelper;
}