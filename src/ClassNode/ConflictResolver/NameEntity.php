<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Prototype\ClassNode\ConflictResolver;

final class NameEntity extends AbstractEntity
{
    /**
     * @param string $name
     * @param int    $sequence
     * @return NameEntity
     */
    public static function createWithSequence(string $name, int $sequence): NameEntity
    {
        $self = new self();
        $self->name = $name;
        $self->sequence = $sequence;

        return $self;
    }

    /**
     * @param string $name
     * @return NameEntity
     */
    public static function create(string $name): NameEntity
    {
        $self = new self();
        $self->name = $name;

        return $self;
    }
}
