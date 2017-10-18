<?php
namespace App\Middleware;

use Interop\Container\ContainerInterface;

abstract class AbstractMiddleware
{
    /**
     * @var ContainerInterface
     */
    protected $c;

    /**
     * Middleware constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
}
