# LaravelSocialiteAuth

A quick drop-in solution for Laravel 8 to authenticate users with Laravel Socialite.
Only Google currently supported.

## Installation

Via Composer

``` bash
$ composer require ndg0/laravel-socialite-auth
```

## Usage

Add this to your `.env`
```
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=https://example.com/login/social/google/callback
```

Now your `/login` page will prompt users to authenticate via Google.
If user is not in your Database, he will be automatically added.
`App\Models\User` is being used.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.
