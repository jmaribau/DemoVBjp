<?php

declare(strict_types=1);

namespace VirtualFileSystem\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use VirtualFileSystem\Folder\Folder;
use VirtualFileSystem\Folder\FolderInterface;
use VirtualFileSystem\Node\NodeAbstract;
use VirtualFileSystem\Node\NodeInterface;

/**
 * @internal
 * @covers \Folder
 */
final class FolderTest extends TestCase
{
    private $folder;

    public function setUp(): void
    {
        $this->folder = new Folder('abc');
    }

    public function testFolderCreate(): void
    {
        $this->assertInstanceOf(FolderInterface::class, $this->folder);
        $this->assertInstanceOf(NodeInterface::class, $this->folder);
        $this->assertInstanceOf(NodeAbstract::class, $this->folder);

        $this->assertEquals('abc', $this->folder->getName());
        $this->assertInstanceOf(\DateTime::class, $this->folder->getDate());
        $this->assertNull($this->folder->getParent());
        $this->assertEmpty($this->folder->getChildren());
    }

    public function testAddChild(): void
    {
        $child = new Folder('ghi');
        $this->folder->addChild($child);

        $children = $this->folder->getChildren();

        $this->assertCount(1, $children);
        $this->assertContainsOnlyInstancesOf(NodeInterface::class, $children);
        $this->assertContainsOnlyInstancesOf(Folder::class, $children);
    }

    public function testRemoveChild(): void
    {
        $child = new Folder('ghi');
        $this->folder->removeChild($child);

        $this->folder->addChild($child);
        $this->assertNotEmpty($this->folder->getChildren());

        $this->folder->removeChild($child);
        $children = $this->folder->getChildren();
        $this->assertEmpty($this->folder->getChildren());
    }

    public function testRemoveAllChildren(): void
    {
        $child = new Folder('ghi');
        $this->folder->addChild($child);

        $this->folder->removeAllChildren();
        $this->assertEmpty($this->folder->getChildren());
    }

    public function testToArray(): void
    {
        $folderArray = $this->folder->toArray();
        $this->assertArrayHasKey('name', $folderArray);
        $this->assertIsString($folderArray['name']);
        $this->assertArrayHasKey('date', $folderArray);
        $this->assertInstanceOf(DateTime::class, $folderArray['date']);
        $this->assertArrayHasKey('isFolder', $folderArray);
        $this->assertIsBool($folderArray['isFolder']);
    }
}
