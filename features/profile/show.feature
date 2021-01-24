@profile

Feature: Test if show profile feature works correctly

    Background:
        Given there are users created:
            | id | email              |
            | 1  | john@example.com   |
            | 2  | oliver@example.com |
            | 3  | alice@example.com  |

    Scenario: A guest is trying to show a user profile
        Given a user is requesting "/api/profiles/1"
        When a request is sent
        Then a response status code should be "401"

    Scenario: A logged in user is trying to show a user profile
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles/1"
        When a request is sent
        Then a response status code should be "200"

    Scenario: A logged in user is trying to show a non-existing user profile
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles/1321"
        When a request is sent
        Then a response status code should be "404"

    Scenario: A logged in user is trying to list user profiles
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles"
        When a request is sent
        Then a response status code should be "404"
