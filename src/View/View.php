<?php

declare(strict_types=1);

namespace VirtualFileSystem\View;

use VirtualFileSystem\Folder\File;
use VirtualFileSystem\Folder\Folder;
use VirtualFileSystem\Folder\FolderInterface;
use VirtualFileSystem\Node\NodeInterface;

/**
 * Class View.
 */
class View implements ViewInterface
{
    private const DEFAULT_TEMPLATE = 'templates/default.php';
    private const DATEFORMAT = 'Y-m-d H:i:s';

    /**
     * @var string
     */
    private $template = self::DEFAULT_TEMPLATE;

    /**
     * @var FolderInterface
     */
    private $folder;

    /**
     * View constructor.
     *
     * @param FolderInterface $folderInterface
     */
    public function __construct(FolderInterface $folderInterface)
    {
        $this->folder = $folderInterface;
    }

    /**
     * @param string $template
     *
     * @return ViewInterface
     */
    public function setTemplate(string $template): ViewInterface
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param FolderInterface $folderInterface
     *
     * @return ViewInterface
     */
    public function setFolder(FolderInterface $folderInterface): ViewInterface
    {
        $this->folder = $folderInterface;

        return $this;
    }

    /**
     * @return FolderInterface
     */
    public function getFolder(): FolderInterface
    {
        return $this->folder;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $data = $this->getData();
        extract($data, EXTR_OVERWRITE);
        ob_start();
        include $this->template;
        /** @var string $buffer */
        $buffer = ob_get_clean();

        return $buffer;
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $data['breadcrumb'] = $this->getBreadcrumb();
        $data['list'] = $this->getList();

        return $data;
    }

    /**
     * @return array
     */
    private function getBreadcrumb(): array
    {
        /** @var NodeInterface $node */
        $node = $this->folder;
        $breadcrumb[] = $node->getName();
        $parent = $node->getParent();
        while (null !== $parent) {
            array_unshift($breadcrumb, $parent->getName());
            $parent = $parent->getParent();
        }

        return $breadcrumb;
    }

    /**
     * @return array
     */
    private function getList(): array
    {
        $items = $this->getNodes();

        return $this->renderNodes($items);
    }

    /**
     * @return array
     */
    private function getNodes(): array
    {
        $dots = $this->getDots();
        $folders = $this->getFolders();
        $files = $this->getFiles();

        return array_merge($dots, $folders, $files);
    }

    /**
     * @param array $nodes
     *
     * @return array
     */
    private function renderNodes(array $nodes): array
    {
        return array_map(static function ($node) {
            /** @var NodeInterface $node */
            $nodeArray = $node->toArray();

            return [
                'name' => $nodeArray['name'],
                'created' => $nodeArray['date']->format(self::DATEFORMAT),
                'directory' => $nodeArray['isFolder'] ? 1 : 0,
            ];
        }, $nodes);
    }

    /**
     * @return array
     */
    private function getDots(): array
    {
        /** @var NodeInterface $node */
        $node = $this->folder;

        $oneDot = clone $node;
        $oneDot->setName('.');

        $dots[] = $oneDot;

        if (!$node->isRoot()) {
            /** @var NodeInterface $parent */
            $parent = $node->getParent();
            $twoDots = clone $parent;
            $twoDots->setName('..');
            $dots[] = $twoDots;
        }

        return $dots;
    }

    /**
     * @return array
     */
    private function getFolders(): array
    {
        return $this->getChildrenByType(Folder::class);
    }

    /**
     * @return array
     */
    private function getFiles(): array
    {
        return $this->getChildrenByType(File::class);
    }

    /**
     * @param string $className
     *
     * @return array
     */
    private function getChildrenByType(string $className): array
    {
        $children = $this->folder->getChildren();

        return array_filter($children, static function ($child) use ($className) {
            return get_class($child) === $className;
        });
    }
}
