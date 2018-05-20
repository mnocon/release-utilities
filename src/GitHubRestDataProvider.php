<?php

declare(strict_types=1);

namespace ReleaseUtilities;

class GitHubRestDataProvider implements IGitDataProvider
{
    /** @var IRestClient */
    private $restClient;

    /** @var  string  */
    private $repositoryName;

    public function __construct(IRestClient $restClient, string $repositoryName)
    {
        $this->restClient     = $restClient;
        $this->repositoryName = $repositoryName;
    }


    public function getCompareResponse(string $from, string $to) : Response
    {
        $response = $this->restClient->get($this->repositoryName);

        if ($response->statusCode !== 200) {
            throw new InvalidVersion($from, $to);
        }

        return $response;
    }
}
