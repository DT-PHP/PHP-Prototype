<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Prototyping\NodeVisitors;

use PhpParser\Builder\Use_;
use PhpParser\Node;

/**
 * Add use statement to the code.
 */
class AddUse extends AbstractVisitor
{
    /** @var array */
    private $dependencies;

    /**
     * @param array $dependencies
     */
    public function __construct(array $dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @param Node $node
     * @return int|null|Node|Node[]
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Namespace_) {
            return null;
        }

        $placementID = 0;
        foreach ($node->stmts as $index => $child) {
            $placementID = $index;
            if ($child instanceof Node\Stmt\Class_) {
                break;
            }
        }

        $nodes = [];
        foreach ($this->dependencies as $name => $type) {
            $nodes[] = $this->buildUse($name, $type);
        }

        $node->stmts = $this->injectNodes($node->stmts, $placementID, $nodes);

        return $node;
    }

    /**
     * @param string $name
     * @param string $type
     * @return Node\Stmt\Use_
     */
    private function buildUse(string $name, string $type): Node\Stmt\Use_
    {
        $b = new Use_(new Node\Name($type), Node\Stmt\Use_::TYPE_NORMAL);
        return $b->getNode();
    }
}