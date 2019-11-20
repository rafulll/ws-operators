<?php

namespace Config;

use Slim\App;
use Controllers\V1\OperatorController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class Routes {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;

        if (!empty($this->app)) {
            $this->initRoutesV1();
        } else {
            throw new Exception("Slim não iniciado.");
        }
    }
    
    private function initRoutesV1() {
        $app = $this->app;
        $container = $app->getContainer();

        // Register component on container
        $container['view'] = function ($container) {
            $view = new \Slim\Views\Twig('app\views',[
                'cache' => false
            ]);
        
            // Instantiate and add Slim specific extension
            $router = $container->get('router');
            $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
            $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
        
            return $view;
        };
        $app->group("/v1", function() use ($app) {
            $view = new \Slim\Views\PhpRenderer("..\views");
            /* Métodos GET */
            $app->get("/status", array(OperatorController::class,"getStatus"));
            /* ----------- */
            $app->get('/test/{name}', function (Request $request, Response $response, array $args){
                return $this->view->render($response, '/v_home.php', [
                    'name' => $args['name']
                ])->setName('v_home');
              });
              $app->get('/teste/{name}', function (Request $request, Response $response, array $args) use($view){
                return $view->render($response, '\v_home.php', ['name' =>$args['name']]);
              });
              $app->get('/pay', function (Request $request, Response $response, array $args) use ($view){
                    return $view->render($response, '\pay.php');
              });
              $app->post("/pay/{operator}", array(OperatorController::class,"pay"));
            /* Métodos POST */
			
        });
    }
}
