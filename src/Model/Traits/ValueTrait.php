<?php

namespace JonathanGuo\CodeGenerator\Model\Traits;

/**
 * Trait PHPValueTrait
 * @package JonathanGuo\CodeGenerator\Model\Traits
 */
trait ValueTrait
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    protected function renderValue()
    {
        return $this->renderTyped($this->value);
    }

    /**
     * @param mixed $value
     * @return string|null
     */
    protected function renderTyped($value)
    {
        $type = gettype($value);

        switch ($type) {
            case 'boolean':
                return $value ? 'true' : 'false';
            case 'int':
                return $value;
            case 'string':
                return sprintf('\'%s\'', addslashes($value));
            case 'array':
                $parts = [];
                foreach ($value as $item) {
                    $parts[] = $this->renderTyped($item);
                }

                // Always break into multiple lines and add trailing comma if there are more than 3 items
                if (count($parts) <= 3) {
                    return sprintf('[%s]', implode(', ', $parts));
                }

                return '[' . PHP_EOL
                    . implode(',' . PHP_EOL, $parts)
                    // Always add trailing comma and line break
                    . ',' . PHP_EOL
                    . ']';
            default:
                return null; // TODO: how to render null explicitly?
        }
    }
}
