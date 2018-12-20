<?php

namespace JonathanGuo\CodeGenerator;

/**
 * Interface RenderableInterface
 * @package JonathanGuo\CodeGenerator
 */
interface RenderableInterface
{
    /**
     * @param int $indent
     * @param string $delimiter
     * @return string
     */
    public function render($indent = 0, $delimiter = PHP_EOL);
}
