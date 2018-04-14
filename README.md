# Restful API

```
$ composer require wbadrh/restapi
```

- [public_html/.htaccess](public_html/.htaccess)

index.php:
```php
require __DIR__ . '/../vendor/autoload.php';

new \wbadrh\RestAPI\Router;
```

- [src/Controller.php](src/Controller.php)
