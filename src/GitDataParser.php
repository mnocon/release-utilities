<?php

declare(strict_types=1);

namespace ReleaseUtilities;

class GitDataParser implements IGitDataParser
{
    /** @var IGitDataProvider */
    private $dataProvider;

    public function __construct(IGitDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return string[]
     */
    public function listChanges(string $versionFrom, string $versionTo) : array
    {
        $response = $this->dataProvider->getCompareResponse($versionFrom, $versionTo);
        if ($response->statusCode === 404) {
            throw new InvalidVersion($versionFrom, $versionTo);
        }

        return [];
    }
}
