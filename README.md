
# Tadasei/laravel-contacts

This package provides stubs for contacts association (with various contact methods) to Eloquent models.

## Features

- Quickly generate contacts migrations, models, factories and enums.
- Customize and extend generated code to fit your project's needs.
- Improve development efficiency by eliminating repetitive tasks.

## Installation

You can install the package via Composer by running:

```bash
composer require tadasei/laravel-contacts --dev
```

### Publishing contacts handling utilities

To publish contacts handling utilities, use the following command:

```bash
php artisan contacts:install
```

### Configuring The Country Model

By default, this package uses the `Country` model from [nnjeim/world](https://github.com/nnjeim/world) to add phone code support for the following contact method types:

* `landline`
* `mobile`
* `fax`

To use a different model, edit `App\Models\ContactMethod` and `Database\Factories\ContactMethodFactory` accordingly.

### Configuring Contactable Models

To extend or define which models are considered *contactable*, edit:

* `App\Enums\ContactableType`: Add your model class names to this enum.
* `Database\Factories\ContactFactory`: Customize logic to generate contacts for your specific model types.

This allows full flexibility in defining how your application links contacts to models.

### Running migrations

To create the related `contacts` and `contact_methods` tables, run the generated migrations using the following command:

```bash
php artisan migrate
```

## Usage:

```php
$contact = $customer->contacts()->create([
    'name' => 'John Doe',
]);

$contact->contactMethods()->create([
    'type' => 'email',
    'value' => 'john@example.com',
]);
```

## Customization

The generated code serves as a starting point. You can customize and extend it according to your project's requirements. Modify the generated utilities as needed.

## Contributing

Contributions are welcome! If you have suggestions, bug reports, or feature requests, please open an issue on the GitHub repository.

## License

This package is open-source software licensed under the [MIT license](LICENSE).
