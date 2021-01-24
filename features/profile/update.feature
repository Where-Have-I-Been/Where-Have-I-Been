@profile

Feature: Test if update profile feature works correctly

    Background:
        Given there are users created:
            | id | email              |
            | 1  | john@example.com   |
            | 2  | oliver@example.com |
            | 3  | alice@example.com  |
        And there are countries created:
            | id | country_name |
            | 1  | poland       |
            | 2  | england      |

    Scenario: A user is trying to update own profile
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles/1" using "PUT"
        When a request is sent
        Then a response status code should be "200"

    Scenario: A user is trying to update other profile
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles/2" using "PUT"
        When a request is sent
        Then a response status code should be "403"

    Scenario: A user is trying to update his nationality with correct data
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles/1" using "PUT"
        And request body contains "country_id" equal "1"
        When a request is sent
        Then a response status code should be "200"

    Scenario: A user is trying to update his nationality with wrong data
        Given a user is logged in as "john@example.com"
        And a user is requesting "/api/profiles/1" using "PUT"
        And request body contains "country_id" equal "3"
        When a request is sent
        Then a response status code should be "422"
