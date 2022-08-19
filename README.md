## About Tworra

This is a Twitter clone built on Laravel Jetstream with Inertia. 

> My intention is to use it for Educational purposes.
> 
> You are free to use it as you please as long as you don't infringe on Twitter Inc intellectual rights or harm its users.

<img width="1440" alt="image" src="https://user-images.githubusercontent.com/1807304/185609082-7f8363b9-4bad-4cf0-afa4-02bc3b616d15.png">
<img width="1440" alt="image" src="https://user-images.githubusercontent.com/1807304/185608989-f6e81ad4-8c6f-4b9e-beff-6576940ed58c.png">


In its current form, you can Tweet, Like Tweets, Follow/Unfollow, view user profiles and show timeline. 
Some features e.g retweet, and threads do not work and are not planned for.

## Installing

I have tested the application to work with Sail but should work like any other Laravel Application.

```bash
git clone https://github.com/SamuelMwangiW/tworra.git
cd tworra
cp .env.example .env
```

Update the `.env` with your ENVIRONMENT configuration

```bash
composer install
npm install
# if using sail
vendor/bin/sail up -d
vendor/bin/sail artisan migrate
# If using artisan:serve
php artisan migrate
php artisan serve
```

## Testing
The application uses pestPHP for testing, Larastan for static analysis and Laravel Pint for styling

```bash
php artisan test
vendor/bin/phpstan
vendor/bin/pint --test
```

## Credits
 - [Constantin Druc's TY series](https://www.youtube.com/watch?v=wpRWrrH9AcI&list=PLUMh5Fzy8HsluM8gWklbZMEmjpwt8HQdU)
 - [Laravel team](https://laravel.com/)
 - [Inertia](https://inertiajs.com/)

## Security Vulnerabilities

If you discover a security vulnerability specific to Laravel, please refer to the [Laravel Security Policy](https://github.com/laravel/framework/security/policy).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
