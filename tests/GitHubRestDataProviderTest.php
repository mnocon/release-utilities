<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest;

use PHPUnit\Framework\TestCase;
use ReleaseUtilities\GitHubRestDataProvider;
use ReleaseUtilities\InvalidVersion;
use ReleaseUtilities\IRestClient;
use ReleaseUtilities\Response;

final class GitHubRestDataProviderTest extends TestCase
{
    public function testShouldThrowExceptionWhenStatusCodeIsDifferentThan200() : void
    {
        $this->expectException(InvalidVersion::class);

        $restClientStub = $this->createMock(IRestClient::class);
        $restClientStub->method('get')
            ->willReturn(new Response(404, ''));

        $dataProvider = new GitHubRestDataProvider($restClientStub, 'repositoryName');
        $dataProvider->getCompareResponse('version1', 'version2');
    }

    public function testShouldReturnResponseWhenStatusCodeIs200() : void
    {
        $expectedResponse = new Response(200, 'TestResponse');
        $restClientStub   = $this->createMock(IRestClient::class);
        $restClientStub->method('get')
            ->willReturn($expectedResponse);

        $dataProvider = new GitHubRestDataProvider($restClientStub, 'repositoryName');

        $this->assertEquals($expectedResponse, $dataProvider->getCompareResponse('', ''));
    }
}
