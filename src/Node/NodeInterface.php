<?php

declare(strict_types=1);

namespace VirtualFileSystem\Node;

use DateTime;

/**
 * Interface NodeInterface.
 */
interface NodeInterface
{
    /**
     * @param string $name
     *
     * @return NodeInterface
     */
    public function setName(string $name): NodeInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param DateTime $date
     *
     * @return NodeInterface
     */
    public function setDate(DateTime $date): NodeInterface;

    /**
     * @return DateTime
     */
    public function getDate(): DateTime;

    /**
     * @param null|NodeInterface $parent
     *
     * @return NodeInterface
     */
    public function setParent(NodeInterface $parent = null): NodeInterface;

    /**
     * @return null|NodeInterface
     */
    public function getParent(): ?NodeInterface;

    /**
     * @return bool
     */
    public function isRoot(): bool;

    /**
     * @return array
     */
    public function toArray(): array;
}
