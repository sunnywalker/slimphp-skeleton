<?php
namespace App\Controllers\Admin;

use App\Controllers\AbstractController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeAdminController extends AbstractController
{
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->view->render($response, 'admin/index.twig', [
        ]);
    }
}
