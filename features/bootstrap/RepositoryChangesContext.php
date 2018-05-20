<?php

declare(strict_types=1);

namespace ReleaseUtilitiesTest\Features;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use ReleaseUtilities\GitDataParser;
use ReleaseUtilitiesTest\GitHubDataProviderStub;

class RepositoryChangesContext implements Context
{
    private $repositoryName;
    private $actualChanges;
    private $expectedChanges;

    public function __construct()
    {
        $this->expectedChanges = [
            'Commit 4',
            'Commit 5',
            'Commit 6',
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
        $repository          = new GitDataParser(new GitHubDataProviderStub($this->repositoryName));
        $this->actualChanges = $repository->listChanges($version1, $version2);
    }
}
