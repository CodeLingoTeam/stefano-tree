<?php

declare(strict_types=1);

namespace StefanoTree\NestedSet\AddStrategy;

use StefanoTree\NestedSet\NodeInfo;

class Top extends AddStrategyAbstract
{
    /**
     * {@inheritdoc}
     */
    protected function canCreateNewNode(NodeInfo $targetNode): bool
    {
        return ($targetNode->isRoot()) ? false : true;
    }

    /**
     * {@inheritdoc}
     */
    protected function makeHole(NodeInfo $targetNode): void
    {
        $moveFromIndex = $targetNode->getLeft() - 1;
        $this->getAdapter()->moveLeftIndexes($moveFromIndex, 2, $targetNode->getScope());
        $this->getAdapter()->moveRightIndexes($moveFromIndex, 2, $targetNode->getScope());
    }

    /**
     * {@inheritdoc}
     */
    protected function createNewNodeNodeInfo(NodeInfo $targetNode): NodeInfo
    {
        return new NodeInfo(
            null,
            $targetNode->getParentId(),
            $targetNode->getLevel(),
            $targetNode->getLeft(),
            $targetNode->getLeft() + 1,
            $targetNode->getScope()
        );
    }
}
