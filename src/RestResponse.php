<?php

declare(strict_types=1);

namespace ReleaseUtilities;

class RestResponse
{
    /** @var int */
    public $statusCode;

    /** @var string */
    public $responseBody;

    public function __construct(int $statusCode, string $responseBody)
    {
        $this->statusCode   = $statusCode;
        $this->responseBody = $responseBody;
    }
}
