<?php

/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Valentin V (vvval)
 */

declare(strict_types=1);

namespace Spiral\Tests\Prototype\Traverse;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class ConstructorParamsVisitor extends NodeVisitorAbstract
{
    /** @var array */
    private $params = [];

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node): void
    {
        if ($node instanceof Node\Stmt\ClassMethod && $node->name->name === '__construct') {
            foreach ($node->params as $param) {
                if ($param->type instanceof Node\NullableType) {
                    if ($param->type->type instanceof Node\Identifier) {
                        $type = $param->type->type->name;
                    } else {
                        $type = implode('\\', $param->type->type->parts);
                    }

                    $type = "?$type";
                } elseif ($param->type instanceof Node\Name) {
                    $type = implode('\\', $param->type->parts);
                } else {
                    $type = $param->type->name ?? null;
                }

                $this->params[$param->var->name] = [
                    'type'     => $type,
                    'optional' => !empty($param->default),
                    'byRef'    => !empty($param->byRef),
                    'variadic' => !empty($param->variadic),
                ];
            }
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
