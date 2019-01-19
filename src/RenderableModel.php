<?php

namespace JonathanGuo\CodeGenerator;

use JonathanGuo\CodeGenerator\Exception\GeneratorException;

/**
 * Class RenderableModel
 * @package JonathanGuo\CodeGenerator
 */
abstract class RenderableModel implements RenderableInterface, LineableInterface
{
    /**
     * {@inheritDoc}
     */
    final public function render($indent = 0, $delimiter = PHP_EOL)
    {
        $this->validate();
        $lines = $this->toLines();

        if (!is_array($lines)) {
            $lines = [$lines];
        }

        if ($indent > 0) {
            $indentStr = str_repeat(' ', $indent);
            array_walk($lines, function (&$item) use ($indentStr) {
                $indent = str_repeat($indentStr, 2);
                $item = $indentStr . str_replace(PHP_EOL, PHP_EOL . $indent, $item);

                // If the item is end of multi-lines array, then replace the indent
                $item = str_replace($indent . '];', $indentStr . '];', $item);
            });
        }

        return implode($delimiter, $lines);
    }

    /**
     * @return bool
     */
    protected function validate()
    {
        return true;
    }

    /**
     * @param RenderableInterface[] $array
     * @param int $indent
     * @param string $delimiter
     * @return string
     * @throws GeneratorException
     */
    protected function renderArrayLn(array $array, $indent = 0, $delimiter = PHP_EOL)
    {
        return $this->ln($this->renderArray($array, $indent, $delimiter));
    }

    /**
     * @param RenderableInterface[] $array
     * @param int $indent
     * @param string $delimiter
     * @return string
     * @throws GeneratorException
     */
    protected function renderArray(array $array, $indent = 0, $delimiter = PHP_EOL)
    {
        $lines = [];
        foreach ($array as $item) {
            if (!$item instanceof RenderableInterface) {
                throw new GeneratorException('Invalid item type');
            }

            $lines[] = $item->render($indent);
        }

        return implode($delimiter, $lines);
    }

    /**
     * @param string $line
     * @return string
     */
    protected function ln($line)
    {
        return $line . PHP_EOL;
    }
}
