# laravel-i18next

Transform Laravel translation files into i18next compatible formats at runtime. This package provides a route for i18next to pull translations via `i18next-xhr-backend`

@TODO

- Add example on implementing in a react app (beyond the `views/test.blade.php`)

## Installation

Installation via composer is supported. Run `composer require processmaker/laravel-i18next`. Once installed, you can publish the configuration via `php artisan vendor:publish --tag=i18next`

The `flatten` configuration option (found in `config/i18next.php`) should be set to true if you're using multidimensional arrays for your translations and NOT the Laravel String as Keys.

The `exclude.groups` configuration option allows you to exclude named groups. So if you have `lang/en/custom_group.php`, and want to exclude it, add `custom_group` to the `exclude.groups` key.

## Testing

We use PHPUnit ^7.2 for unit tests on this package. You can execute the tests either by running:

`composer run-script test`
