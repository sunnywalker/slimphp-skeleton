<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthNMiddleware extends AbstractMiddleware
{
    /**
     * @param  Request  $request  PSR7 request
     * @param  Response $response PSR7 response
     * @param  callable $next     Next middleware
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$this->c->authn->isLoggedIn()) {
            return $response->withRedirect($this->c->router->pathFor('log-in'));
        }
        return $next($request, $response);
    }
}
