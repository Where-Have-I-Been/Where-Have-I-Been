@photo

Feature: Test if delete photos feature works correctly

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

    Scenario: A user is trying to delete existing photo
        Given a user is logged in as "alice@example.com"
        And a user is requesting "/api/photos/4" using "DELETE"
        When a request is sent
        Then a response status code should be "200"

    Scenario: A user is trying to delete non-existing photo
        Given a user is logged in as "alice@example.com"
        And a user is requesting "/api/photos/5" using "DELETE"
        When a request is sent
        Then a response status code should be "404"

    Scenario: A user is trying to delete other user photo
        Given a user is logged in as "alice@example.com"
        And a user is requesting "/api/photos/1" using "DELETE"
        When a request is sent
        Then a response status code should be "403"

    Scenario: A user is trying to delete all photos
        Given a user is logged in as "alice@example.com"
        And a user is requesting "/api/photos" using "DELETE"
        When a request is sent
        Then a response status code should be "405"
