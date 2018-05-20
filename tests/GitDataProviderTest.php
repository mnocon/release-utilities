<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest;

use PHPUnit\Framework\TestCase;
use ReleaseUtilities\GitDataParser;
use ReleaseUtilities\InvalidVersion;

final class GitDataProviderTest extends TestCase
{
    /** @var GitHubDataProviderStub */
    private $gitDataProvider;

    /** @var IGitDataParser */
    private $repository;

    /** @var string */
    private $repositoryName;

    protected function setUp() : void
    {
        $this->repositoryName  = 'testRepository';
        $this->gitDataProvider = new GitHubDataProviderStub($this->repositoryName);
        $this->repository      = new GitDataParser($this->gitDataProvider);
    }

    public function testShouldReturnEmptyWhenVersionIsTheSame() : void
    {
        $version = 'version1';
        $changes = $this->repository->listChanges($version, $version);

        $this->assertCount(0, $changes);
    }

    public function testShouldThrowExceptionWhenVersionNotPresent() : void
    {
        $this->expectException(InvalidVersion::class);
        $this->expectExceptionMessage('Unrecognised versions: VERSION_NOT_EXIST version2');

        $this->repository->listChanges('VERSION_NOT_EXIST', 'version2');
    }
}
