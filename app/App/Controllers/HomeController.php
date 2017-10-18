<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends AbstractController
{
    /**
     * Home page.
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  array    $args
     * @return Response
     */
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->view->render($response, 'index.twig', [
        ]);
    }
}
