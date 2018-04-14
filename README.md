# Restful API

```
$ composer require wbadrh/restapi
```

index.php:
```php
require __DIR__ . '/../vendor/autoload.php';

new \wbadrh\RestAPI\Router;
```

.htaccess:
```Apache
################################################################

SetEnv  scheme  "http"
SetEnv  host    "domain.ext"

# $method = [GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS]
# $filter = [number, word, alphanum_dash, slug, uuid]
#         = [0-9]+

# SetEnv $method[/route/{arg1}/{arg2:$filter}] Controller::action

SetEnv  GET[/]        wbadrh\\RestAPI\\Controller::response
SetEnv  GET[/{name}]  wbadrh\\RestAPI\\Controller::response_args


################################################################

# https://httpd.apache.org/docs/trunk/mod/mod_dir.html
<IfModule mod_dir.c>
    # Route all to Frontcontroller
    FallbackResource /
</IfModule>

################################################################

```

- [src/Controller.php](src/Controller.php)
