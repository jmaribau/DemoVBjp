<?php

declare(strict_types=1);

namespace VirtualFileSystem\Folder;

use VirtualFileSystem\Node\NodeAbstract;
use VirtualFileSystem\Node\NodeInterface;

/**
 * Class Folder.
 */
class Folder extends NodeAbstract implements FolderInterface
{
    /**
     * @var array
     */
    private $children = [];

    /**
     * @param NodeInterface $child
     *
     * @return FolderInterface
     */
    public function addChild(NodeInterface $child): FolderInterface
    {
        $child->setParent($this);
        $this->children[] = $child;

        return $this;
    }

    /**
     * @param NodeInterface $child
     *
     * @return FolderInterface
     */
    public function removeChild(NodeInterface $child): FolderInterface
    {
        foreach ($this->children as $key => $value) {
            if ($child === $value) {
                unset($this->children[$key]);
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return FolderInterface
     */
    public function removeAllChildren(): FolderInterface
    {
        $this->children = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'date' => $this->getDate(),
            'isFolder' => true,
        ];
    }
}
