@models

Feature: Test if user model works correctly

    Scenario: When user is created, profile should be assigned
        When there is a user created
        Then it should have profile assigned
