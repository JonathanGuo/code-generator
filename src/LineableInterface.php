<?php

namespace JonathanGuo\CodeGenerator;

/**
 * Interface LineableInterface
 * @package JonathanGuo\CodeGenerator
 */
interface LineableInterface
{
    /**
     * @return string|string[]
     */
    public function toLines();
}