<?php

declare(strict_types=1);

namespace ReleaseUtilities;

interface IGitDataProvider
{
    public function getCompareResponse(string $from, string $to) : Response;
}
