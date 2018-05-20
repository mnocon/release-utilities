<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest;

use PHPUnit\Framework\TestCase;
use ReleaseUtilities\GitHubDataParser;
use function count;

final class GitDataParserTest extends TestCase
{
    /** @var GitHubRestDataProviderStub */
    private $gitDataProvider;

    protected function setUp() : void
    {
        $this->gitDataProvider = new GitHubRestDataProviderStub();
    }

    public function testShouldReturnEmptyWhenVersionIsTheSame() : void
    {
        $response = $this->gitDataProvider->getSameVersionCompareResponse();

        $parser  = new GitHubDataParser($response->responseBody);
        $changes = $parser->listChanges();

        $this->assertCount(0, $changes);
    }

    public function testShouldReturnEmptyWhenSecondVersionIsBehind() : void
    {
        $response = $this->gitDataProvider->getBehindCompareResponse();

        $parser = new GitHubDataParser($response->responseBody);

        $this->assertCount(0, $parser->listChanges());
    }

    public function testShouldReturnChangesWhenSecondVersionIsAhead() : void
    {
        $response = $this->gitDataProvider->getAheadCompareResponse();

        $parser = new GitHubDataParser($response->responseBody);

        $this->assertGreaterThan(0, count($parser->listChanges()));
    }
}
