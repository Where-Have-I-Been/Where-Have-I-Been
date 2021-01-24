@auth

Feature: Test if authentication works

    Scenario: User is attempting to register using valid data
        Given a user is requesting "/api/register" using "POST"
        And request body contains "username" equal "name"
        And request body contains "email" equal "testuser@gmail.com"
        And request body contains "password" equal "password"
        And request body contains "password_confirmation" equal "password"
        When a request is sent
        Then a response status code should be "200"

    Scenario: User is attempting to register using invalid data
        Given a user is requesting "/api/register" using "POST"
        And request body contains "username" equal "name"
        And request body contains "email" equal "testuser@"
        And request body contains "password" equal "secret"
        And request body contains "password_confirmation" equal "secret123"
        When a request is sent
        Then a response status code should be "422"

    Scenario: User is attempting to register using empty data
        Given a user is requesting "/api/register" using "POST"
        When a request is sent
        Then a response status code should be "422"

    Scenario: User is attempting to register using existing email
        Given a user is requesting "/api/register" using "POST"
        And request body contains "username" equal "name"
        And request body contains "email" equal "test@example.com"
        And request body contains "password" equal "secret"
        And request body contains "password_confirmation" equal "secret"
        And there is a user created:
            | email            |
            | test@example.com |
        When a request is sent
        Then a response status code should be 422
