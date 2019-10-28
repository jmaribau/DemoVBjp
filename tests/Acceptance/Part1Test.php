<?php

declare(strict_types=1);

namespace VirtualFileSystem\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use VirtualFileSystem\Folder\File;
use VirtualFileSystem\Folder\Folder;
use VirtualFileSystem\Folder\FolderInterface;
use VirtualFileSystem\Node\NodeAbstract;
use VirtualFileSystem\Node\NodeInterface;

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
            ->addChild($images = new Folder('ImagesTest'))
            ->addChild(new Folder('src'))
            ->addChild(new Folder('tests'))
            ->addChild(new File('README.md'));

        $images
            ->addChild(new File('main_logo.png'))
            ->addChild(new File('main_small.png'))
            ->addChild(new File('icons.png'));

        $view = new View($myProject);
        $myProjectRender = $view->render();

        $view->setFolder($images);
        $imagesRender = $view->render();

        $this->assertEquals('HomeTest', $home->getName());
        $this->assertTrue($home->isRoot());
        $this->assertNull($home->getParent());
        $this->assertInstanceof(DateTime::class, $home->getDate());

        $this->assertCount(1, $home->getChildren());
        $this->assertContainsOnlyInstancesOf(Folder::class, $home->getChildren());
        $this->assertContainsOnlyInstancesOf(FolderInterface::class, $home->getChildren());
        $this->assertContainsOnlyInstancesOf(NodeAbstract::class, $home->getChildren());
        $this->assertContainsOnlyInstancesOf(NodeInterface::class, $home->getChildren());
        $this->assertEquals('MyProjectTest', $home->getChildren()[0]->getName());

        $this->assertEquals('MyProjectTest', $myProject->getName());
        $this->assertFalse($myProject->isRoot());
        $this->assertNotNull($myProject->getParent());
        $this->assertInstanceof(DateTime::class, $myProject->getDate());

        $this->assertCount(4, $myProject->getChildren());
        $this->assertContainsOnlyInstancesOf(NodeAbstract::class, $myProject->getChildren());
        $this->assertContainsOnlyInstancesOf(NodeInterface::class, $myProject->getChildren());

        $this->assertEquals('ImagesTest', $images->getName());
        $this->assertFalse($images->isRoot());
        $this->assertNotNull($images->getParent());
        $this->assertInstanceof(DateTime::class, $images->getDate());

        $this->assertCount(3, $images->getChildren());
        $this->assertContainsOnlyInstancesOf(File::class, $images->getChildren());
        $this->assertContainsOnlyInstancesOf(NodeAbstract::class, $images->getChildren());
        $this->assertContainsOnlyInstancesOf(NodeInterface::class, $images->getChildren());

        $this->assertStringContainsString('. /', $myProjectRender);
        $this->assertStringContainsString('.. /', $myProjectRender);

        $this->assertStringContainsString('. /', $imagesRender);
        $this->assertStringContainsString('.. /', $imagesRender);
    }
}
