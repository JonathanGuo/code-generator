<?php

namespace JonathanGuo\CodeGenerator\Model;

use JonathanGuo\CodeGenerator\RenderableModel;

/**
 * Class PHPClassTrait
 * @package JonathanGuo\CodeGenerator\Model
 */
class UseTraitModel extends RenderableModel
{
    /**
     * @var string
     */
    protected $name;

    /**
     * PHPClassTrait constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        return sprintf('use %s;', $this->name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
