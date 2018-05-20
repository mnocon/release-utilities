<?php

declare(strict_types=1);

namespace ReleaseUtilities;

use stdClass;
use function in_array;
use function json_decode;

class GitHubDataParser implements IGitDataParser
{
    private const NO_CHANGES_STATUSES = ['behind', 'identical'];

    /** @var mixed */
    private $response;

    public function __construct(string $responseBody)
    {
        $this->response = json_decode($responseBody);
    }

    /**
     * @return string[]
     */
    public function listChanges() : array
    {
        if (in_array($this->getStatus($this->response), self::NO_CHANGES_STATUSES, true)) {
            return [];
        }

        return $this->parseCommits($this->response->commits);
    }

    private function getStatus(stdClass $response) : string
    {
        return $response->status;
    }

    /**
     * @param mixed[] $commits
     *
     * @return CommitData[]
     */
    private function parseCommits(array $commits) : array
    {
        $parsedCommits = [];

        foreach ($commits as $commit) {
            $parsedCommits[] = new CommitData($commit->sha, $commit->commit->message);
        }

        return $parsedCommits;
    }
}
