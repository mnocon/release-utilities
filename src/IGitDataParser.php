<?php

declare(strict_types=1);

namespace ReleaseUtilities;

interface IGitDataParser
{
    /**
     * @return string[]
     */
    public function listChanges(string $versionFrom, string $versionTo) : array;
}
