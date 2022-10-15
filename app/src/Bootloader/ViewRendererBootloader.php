<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\ErrorHandler\ViewRenderer;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Http\ErrorHandlerBootloader;
use Spiral\Http\ErrorHandler\RendererInterface;

class ViewRendererBootloader extends Bootloader
{
    public const DEPENDENCIES = [
        ErrorHandlerBootloader::class
    ];

    public const SINGLETONS = [
        RendererInterface::class => ViewRenderer::class
    ];
}
