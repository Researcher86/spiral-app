<?php

declare(strict_types=1);

namespace App\Middleware;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsMiddleware implements MiddlewareInterface
{
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            $response = $this->responseFactory->createResponse(500);
            $response->getBody()->write($this->renderWhoops($e));

            return $response;
        }
    }

    private function renderWhoops(Throwable $e): string
    {
        $whoops = new Run();
        $whoops->allowQuit(false);
        $whoops->writeToOutput(false);

        $handler = new PrettyPageHandler();
        $handler->handleUnconditionally(true); // whoops does not know about RoadRunner

        $whoops->prependHandler($handler);

        return $whoops->handleException($e);
    }
}
