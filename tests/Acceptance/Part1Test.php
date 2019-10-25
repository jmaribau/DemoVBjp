<?php

declare(strict_types=1);

namespace VirtualFileSystem\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use VirtualFileSystem\Folder\File;
use VirtualFileSystem\Folder\Folder;
use VirtualFileSystem\View\View;

/**
 * @internal
 */
final class Part1Test extends TestCase
{
    public function testPart1(): void
    {
        $home = new Folder('HomeTest');

        $home
            ->addChild($myProject = new Folder('MyProjectTest'));

        $myProject
            ->addChild($images = new Folder('imagesTest'))
            ->addChild(new Folder('src'))
            ->addChild(new Folder('tests'))
            ->addChild(new File('README.md'));

        $images
            ->addChild(new File('main_logo.png'))
            ->addChild(new File('main_small.png'))
            ->addChild(new File('icons.png'));

        $view = new View($myProject);
        $view->render();

        $view->setFolder($images);
        $view->render();

        $this->assertTrue(true);
    }
}
