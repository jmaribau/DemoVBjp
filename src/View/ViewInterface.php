<?php

declare(strict_types=1);

namespace VirtualFileSystem\View;

use VirtualFileSystem\Folder\FolderInterface;

/**
 * Interface ViewInterface.
 */
interface ViewInterface
{
    /**
     * @param string $template
     *
     * @return ViewInterface
     */
    public function setTemplate(string $template): ViewInterface;

    /**
     * @return string
     */
    public function getTemplate(): string;

    /**
     * @param FolderInterface $folder
     *
     * @return ViewInterface
     */
    public function setFolder(FolderInterface $folder): ViewInterface;

    /**
     * @return FolderInterface
     */
    public function getFolder(): FolderInterface;

    /**
     * @return string
     */
    public function render(): string;
}
