# Laravel API Starter

This is a starter project for Laravel API authentication. 
It includes a user registration and login system. 

There are tests for the registration and login.

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `php artisan migrate`
4. Run `php artisan serve`

## Usage

### Registration

To register a user, send a POST request to `/api/register` with the following parameters:

- `name`
- `email`
- `password`

### Login

To login a user, send a POST request to `/api/login` with the following parameters:

- `email`
- `password`

The response will include a `token` which you can use to authenticate future requests.

### Logout

To logout a user, send a POST request to `/api/logout` include the `token` in the request headers.

After logging out, the token will no longer be valid.

### Authenticated Requests

To make an authenticated request, include the `token` in the request headers.

### Testing

To run the tests, run `php artisan test`

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
