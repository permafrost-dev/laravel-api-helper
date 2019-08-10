<?php

declare(strict_types=1);

namespace Permafrost\Api\Tests;

use OutOfBoundsException;
use PHPUnit\Framework\TestCase;
use Permafrost\Api\JsonApiHelper;
use Permafrost\Api\JsonApiResponse;

class DateExpanderTest extends TestCase
{
    /**
     * @test
     * @testdox filters an array using its keys
     */
    public function it_sends_success_response() : void
    {
        $apiResponse = new JsonApiResponse;
        $apiResponse->success('OK');
         //$response = $this-> json('POST', '/user', ['name' => 'Sally']);
         $apiResponse->assertStatus(201);
    }
}
