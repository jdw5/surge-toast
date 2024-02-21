# Surge Toast
Server-side counterpart to `surge-toast-client` for Vue/Inertia. It provides a global macro to flash data to the session, with the client library automatically hooked up to receive router events from InertiaJs.

## Installation
Install the package via composer:
```console
composer require jdw5/surge-toast
```

To provide the link to the frontend, ensure you have a middleware for sharing props on all requests via Inertia. The starter kits will have this installed as `HandleInertiaRequests` middleware