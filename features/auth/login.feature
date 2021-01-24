@auth

Feature: Test if user login works

    Background:
        Given there is a user created:
            | email            |
            | test@example.com |

    Scenario: User is attempting to login using correct credentials
        Given a user is requesting "/api/login" using "POST"
        And request body contains "email" equal "test@example.com"
        And request body contains "password" equal "password"
        When a request is sent
        Then a response status code should be "200"

    Scenario: User is attempting to login using wrong credentials
        Given a user is requesting "/api/login" using "POST"
        And request body contains "email" equal "foo@example.com"
        And request body contains "password" equal "password123"
        When a request is sent
        Then a response status code should be "401"

    Scenario: User is attempting to login using empty credentials
        Given a user is requesting "/api/login" using "POST"
        When a request is sent
        Then a response status code should be "422"
