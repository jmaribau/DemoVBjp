<?php

declare(strict_types=1);

namespace VirtualFileSystem\Node;

use DateTime;
use Exception;

/**
 * Class File.
 */
abstract class NodeAbstract implements NodeInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var null|NodeInterface
     */
    private $parent;

    /**
     * File constructor.
     *
     * @param string $name
     *
     * @throws Exception
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->date = new DateTime();
    }

    /**
     * @param string $name
     *
     * @return NodeInterface
     */
    public function setName(string $name): NodeInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param DateTime $date
     *
     * @return NodeInterface
     */
    public function setDate(DateTime $date): NodeInterface
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param null|NodeInterface $parent
     *
     * @return NodeInterface
     */
    public function setParent(NodeInterface $parent = null): NodeInterface
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return null|NodeInterface
     */
    public function getParent(): ?NodeInterface
    {
        return $this->parent;
    }

    /**
     * @return bool
     */
    public function isRoot(): bool
    {
        return null === $this->getParent();
    }
}
