# Surge Toast
Server-side counterpart to `surge-toast-client` for Vue/Inertia. It provides a global macro to flash data to the session, with the client library automatically hooked up to receive router events from InertiaJs.

## Installation
Install the package via composer:
```console
composer require jdw5/surge-toast
```

To provide the link to the frontend, ensure you have a middleware for sharing props on all requests via Inertia. The starter kits will have this installed as `HandleInertiaRequests` middleware. Copy the following to the `share` function in this middleware, or equivalent:

```php
public function share (Requesr $request): array
{
    return [
        ...parent::share($request),
        'toast' => $request->session()->get('toast')
    ]
}
```

This will share all toast messages to your frontend under the property `toast`. To use the client library, use the plugin in the `app.js` file after installing. See the documentation for the Javascript library [here](https://github.com/jdw5/surge-toast-client#readme)

## Usage
The package provides a global way to flash data to the session, via the structure of `ToastData`. ToastData accepts the following parameters:

```php
public function __construct(
    public string $message,
    public ?string $type = ToastType::DEFAULT->value,
    public ?int $duration = self::DEFAULT_DURATION,
    public ?string $title,
    public ?mixed $custom,
) {}
```

You can call the method from a controller through the following ways

```php
toast(new ToastData('A message', 'info'));

toast(ToastData::from([
    'message' => 'A message',
    'duration' => 5000,
    'title' => 'A title',
    'custom' => ['key' => 'value']
    'type' => 'info',
]));

toast([
    'message' => 'Error message',
    'type' => 'error',
    'duration' => 5000,
]);
```

Or any combination of this. This will flash a message to the session with the `type` provided, or will use the `default` type if not specified

You can also shortcut the types using the following methods:

```php
toast()->info('A message');
toast()->success('A message');
toast()->error('A message');
toast()->warning('A message');
```

Which will set the type for you. You can also chain with the `duration` and `title` methods:

```php
toast()->info('A message')->duration(5000)->title('A title');
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.