@photo

Feature: Test if show photos feature works correctly

    Background:
        Given there are users created:
            | id | email              |
            | 1  | john@example.com   |
            | 2  | oliver@example.com |
            | 3  | alice@example.com  |
        And there are photos created:
            | id | user_id |
            | 1  | 1       |
            | 2  | 1       |
            | 3  | 2       |
            | 4  | 3       |

    Scenario: A user is trying to list own photos
        Given a user is logged in as "alice@example.com"
        And a user is requesting "/api/photos/user/3"
        When a request is sent
        Then a response status code should be "200"

    Scenario: A user is trying to list other user photos
        Given a user is logged in as "alice@example.com"
        And a user is requesting "/api/photos/user/1"
        When a request is sent
        Then a response status code should be "403"
