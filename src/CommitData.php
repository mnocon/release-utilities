<?php

declare(strict_types=1);

namespace ReleaseUtilities;

class CommitData
{
    /** @var string */
    public $sha;

    /** @var string */
    public $message;

    public function __construct(string $sha, string $message)
    {
        $this->sha     = $sha;
        $this->message = $message;
    }
}
