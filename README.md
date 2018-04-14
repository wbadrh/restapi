# Restful API

composer.json:
```json
{
    "require": {
        "wbadrh/restapi": "^1.0"
    },
    "autoload": {
        "psr-4": {
            "Name\\Space\\": "src/"
        }
    }
}
```

```
$ composer install
```

public_html/index.php:
```php
require __DIR__ . '/../vendor/autoload.php';

new \wbadrh\RestAPI\Router;
```

public_html/.htaccess:
```Apache
################################################################

SetEnv  scheme  "http"
SetEnv  host    "domain.ext"

# $method = [GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS]
# $filter = [number, word, alphanum_dash, slug, uuid]
#         = [0-9]+

# SetEnv $method[/route/{arg1}/{arg2:$filter}] Controller::action

SetEnv  GET[/]        Name\\Space\\MyController::myResponse
SetEnv  GET[/{name}]  Name\\Space\\MyController::myResponseArgs


################################################################

# https://httpd.apache.org/docs/trunk/mod/mod_dir.html
<IfModule mod_dir.c>
    # Route all to Frontcontroller
    FallbackResource /
</IfModule>

################################################################
```

src/MyController.php:

```php
namespace Name\Space;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

// Throw Not Found
//(new \wbadrh\JSON_API\Response)->exception(404);

// Returns possible exceptions to throw
//print_r($this->reponse->exceptions());

// HTTP status [200,202]

// $requestBody = json_decode($request->getBody(), true);

/**
 * ...
 */
class MyController
{
    /**
     * ...
     *
     * @param ServerRequestInterface   $request  Zend Diactoros server request
     * @param ResponseInterface        $response PSR-7 HTTP response message
     * @return Zend\Diactoros\Response $response Manipulated PSR-7 HTTP response message
     */
    public function myResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        $contents = 'It works!';

        // HTTP status
        $status = 200; 

        // PSR-7 JSON response
        return (new \wbadrh\JSON_API\Response)->dispatch($response, $status, $contents);
    }

    /**
     * ...
     *
     * @param ServerRequestInterface   $request  Zend Diactoros server request
     * @param ResponseInterface        $response PSR-7 HTTP response message
     * @param Array                    $args     URL query parameters
     * @return Zend\Diactoros\Response $response Manipulated PSR-7 HTTP response message
     */
    public function myResponseArgs(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $contents = 'Hello, ' . $args['name'] . '!';

        // HTTP status
        $status = 200; // 202

        // PSR-7 JSON response
        return (new \wbadrh\JSON_API\Response)->dispatch($response, $status, $contents);
    }
}
```
