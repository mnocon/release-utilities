<?php

declare(strict_types=1);

namespace ReleaseUtilities;

use Exception;
use Throwable;
use function sprintf;

class InvalidVersion extends Exception
{
    public function __construct(
        string $versionFrom,
        string $versionTo,
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        $this->message = sprintf('Unrecognised versions: %s %s', $versionFrom, $versionTo);
        parent::__construct($this->message, $code, $previous);
    }
}
