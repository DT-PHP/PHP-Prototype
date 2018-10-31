<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Prototyping\Annotation;

/**
 * Singular annotation line.
 */
final class Line
{
    /** @var string */
    public $value = '';

    /** @var string|null */
    public $type = null;

    /**
     * @param string      $value
     * @param string|null $type
     */
    public function __construct(string $value, string $type = null)
    {
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @param array $type
     * @return bool
     */
    public function is(array $type): bool
    {
        return in_array(strtolower($this->type), $type);
    }

    /**
     * @return bool
     */
    public function isStructured(): bool
    {
        return $this->type != null;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !$this->isStructured() && trim($this->value) == "";
    }
}