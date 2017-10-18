<?php
namespace App\Controllers\Admin;

use App\Controllers\AbstractController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthNController extends AbstractController
{
    /**
     * Log in page.
     */
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->view->render($response, 'admin/log-in.twig', [
            'session' => $_SESSION,
        ]);
    }

    /**
     * Process logging in.
     */
    public function logIn(Request $request, Response $response, $args)
    {
        if ($this->c->authn->logInAttempt($request->getParam('email'), $request->getParam('password'))) {
            $this->c->flash->addMessage('success', 'Logged in.');
            return $response->withRedirect($this->c->router->pathFor('home'));
        }
        $this->c->flash->addMessage('error', 'Could not log in.'); //.password_hash($request->getParam('password'), PASSWORD_DEFAULT));
        return $response->withRedirect($this->c->router->pathFor('log-in'));
    }

    /**
     * Process logging out.
     */
    public function logOut(Request $request, Response $response, $args)
    {
        $this->c->authn->logOut();
        return $response->withRedirect($this->c->router->pathFor('home'));
    }
}
