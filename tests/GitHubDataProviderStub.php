<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest;

use ReleaseUtilities\IGitDataProvider;
use ReleaseUtilities\RestResponse;
use function file_get_contents;
use function in_array;

class GitHubDataProviderStub implements IGitDataProvider
{
    public const SUPPORTED_VERSIONS = ['version1', 'version2'];

    /** @var string */
    // TODO:Remove when used
    // @codingStandardsIgnoreLine
    private $repositoryName;

    public function __construct(string $repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }

    public function getCompareResponse(string $from, string $to) : RestResponse
    {
        $this->repositoryName = '';

        if (! in_array($from, self::SUPPORTED_VERSIONS, true) || ! in_array($to, self::SUPPORTED_VERSIONS, true)) {
            return new RestResponse(404, file_get_contents('./tests/GitHubApiResponses/version_not_exist.txt'));
        }

        return new RestResponse(200, file_get_contents('./tests/GitHubApiResponses/same_version.txt'));
    }
}
