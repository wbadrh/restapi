<?php

namespace wbadrh\RestAPI;

/**
 * Application router based on environment
 */
class Router
{
    /**
     * Build router based on environment
     */
    function __construct()
    {
        // Get application environment
        $scheme = getenv('scheme');
        $host   = getenv('host');

        // Upgrade insecure requests
        if ($_SERVER['REQUEST_SCHEME']                 === 'http'
         && $_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS'] === '1'
         && $scheme                                    === 'https'
        ) {
            // Redirect to SSL
            header('Location: https://' . $host . $_SERVER['REQUEST_URI']);
            // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Upgrade-Insecure-Requests
            header('Vary: Upgrade-Insecure-Requests');
            exit;
        }
        else {
            // Application routes container
            $application = [];

            // Environment routes
            $routes = [
                'GET'     => $_SERVER['GET']     ?? false,
                'POST'    => $_SERVER['POST']    ?? false,
                'PUT'     => $_SERVER['PUT']     ?? false,
                'PATCH'   => $_SERVER['PATCH']   ?? false,
                'DELETE'  => $_SERVER['DELETE']  ?? false,
                'HEAD'    => $_SERVER['HEAD']    ?? false,
                'OPTIONS' => $_SERVER['OPTIONS'] ?? false,
            ];

            // Loop method group
            foreach ($routes as $method => $map) {
                // Method defined in environment
                if ($map) {
                    // Loop routes within group
                    foreach ($map as $route => $controller) {
                        // Add route to container
                        $application[] = $this->route($method, $route, $controller);
                    }
                }
            }

            // Run application router
            new \wbadrh\JSON_API\Router([
                'domain' => [
                    'scheme' => $scheme,
                    'host'   => $host
                ],
                'routes' => $application
            ]);
        }
    }

    /**
     * Add route to application
     *
     * @param String $method     HTTP request method
     * @param String $route      Relative slug, with optional arguments & filters
     * @param String $controller Controller::action
     * @return Array Route configuration
     */
    private function route(String $method, String $route, String $controller)
    {
        return [
            'method'     => $method,
            'route'      => $route,
            'controller' => $controller
        ];
    }
}
