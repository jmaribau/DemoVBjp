<?php

declare(strict_types=1);

namespace VirtualFileSystem\Folder;

use VirtualFileSystem\Node\NodeInterface;

/**
 * Interface FolderInterface.
 */
interface FolderInterface
{
    /**
     * @param NodeInterface $child
     *
     * @return FolderInterface
     */
    public function addChild(NodeInterface $child): FolderInterface;

    /**
     * @param NodeInterface $child
     *
     * @return FolderInterface
     */
    public function removeChild(NodeInterface $child): FolderInterface;

    /**
     * @return FolderInterface
     */
    public function removeAllChildren(): FolderInterface;

    /**
     * @return array
     */
    public function getChildren(): array;
}
