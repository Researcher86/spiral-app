<?php

declare(strict_types=1);

use Spiral\Events\Processor\AttributeProcessor;

return [
    /**
     * -------------------------------------------------------------------------
     *  Processors
     * -------------------------------------------------------------------------
     *
     * Array of all available processors.
     */
    'processors' => [
        AttributeProcessor::class,
    ],
];
