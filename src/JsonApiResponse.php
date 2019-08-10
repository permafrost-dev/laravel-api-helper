<?php

namespace Permafrost\Api;

use Illuminate\Http\JsonResponse;

class JsonApiResponse extends JsonResponse
{
    use JsonApiHelper;
}
