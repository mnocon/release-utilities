<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest;

use PHPUnit\Framework\Exception;
use ReleaseUtilities\IGitDataProvider;
use ReleaseUtilities\Response;
use function file_get_contents;

class GitHubRestDataProviderStub implements IGitDataProvider
{
    public function getCompareResponse(string $from, string $to) : Response
    {
        throw new Exception('Not implemented on purposde');
    }

    public function getSameVersionCompareResponse() : Response
    {
        return new Response(200, file_get_contents('./tests/GitHubApiResponses/same_version.txt'));
    }

    public function getBehindCompareResponse() : Response
    {
        return new Response(200, file_get_contents('./tests/GitHubApiResponses/first_version_behind.txt'));
    }

    public function getAheadCompareResponse() : Response
    {
        return new Response(200, file_get_contents('./tests/GitHubApiResponses/differences_present.txt'));
    }
}
