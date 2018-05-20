<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest\Features;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use ReleaseUtilities\CommitData;
use ReleaseUtilities\GitHubDataParser;
use ReleaseUtilitiesTest\GitHubRestDataProviderStub;

class RepositoryChangesContext implements Context
{
    private $repositoryName;
    private $actualChanges;
    private $expectedChanges;

    public function __construct()
    {
        $this->expectedChanges = [
            new CommitData('c7ff18eee7dddb253d10a4a4ff957f192ea3469f', "EZP-29046: As an Editor, I want to have \"Content field definitions\" header sticky to the top (#433)\n\n* EZP-29046: As an Editor, I want to have \"Content field definitions\" header sticky to the top\r\n\r\n* EZP-29046: Styling additions\r\n\r\n* Suggested changes\r\n\r\n* EZP-29046: As an Editor, I want to have \"Content field definitions\" header sticky to the top\r\n\r\n* EZP-29046: Styling additions"),
            new CommitData('127df9641d92669326cbf98b32892eea16264b0e', "Merge branch '1.1'"),
        ];
    }

    /** @Then I see expected list of changes */
    public function iSeeExpectedListOfChanges() : void
    {
        Assert::assertEquals($this->expectedChanges, $this->actualChanges);
    }

    /** @Given I'm checking :repositoryName repository */
    public function iMCheckingRepository($repositoryName) : void
    {
        $this->repositoryName = $repositoryName;
    }

    /** @When I check for differences between :version1 and :version2 */
    public function iCheckForDifferencesBetweenAnd($version1, $version2) : void
    {
        $dataProvider = new GitHubRestDataProviderStub();
        $repository = new GitHubDataParser($dataProvider->getAheadCompareResponse()->responseBody);
        $this->actualChanges = $repository->listChanges();
    }
}
