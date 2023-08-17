<?php

/**
 *  Returns the location of a controller.
 */
function controller(string $controller): string
{
    return __DIR__ . "/../Controller/{$controller}";
}
