Feature: Changes in a single repository are detected and release notes for them are generated

  Scenario: I want to be notified when changes in repository are present
    Given I'm checking "mnocon/release-utilities" repository
    When I check for differences between "version1" and "version2"
    Then I see expected list of changes