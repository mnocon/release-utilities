<?php

declare(strict_types=1);

namespace ReleaseUtilities;

interface IRestClient
{
    public function get(string $endpoint) : Response;
}
