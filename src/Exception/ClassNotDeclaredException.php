<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Prototype\Exception;

class ClassNotDeclaredException extends \Exception
{
    /**
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        parent::__construct("Class declaration not found in \"$filename\" directory.");
    }
}
