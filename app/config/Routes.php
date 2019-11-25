<?php

namespace Config;

use Slim\App;
use Config;
use Slim\Container;
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
    return new \Slim\Views\PhpRenderer('./app/views');
};
        $app->group("/v1", function() use ($app) {
            
            /* Métodos GET */
            $app->get("/status", array(OperatorController::class,"getStatus"));
            /* ----------- */
            $app->get('/hello/{name}', function ($request, $response, $args) {
               
                return $this->view->render($response, "pay.php", $args);
            });
           
           
              $app->post("/pay/{operator}", array(OperatorController::class,"pay"));
            /* Métodos POST */
			
        });
    }
}
