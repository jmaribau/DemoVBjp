<?php

declare(strict_types=1);

namespace VirtualFileSystem\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use VirtualFileSystem\Folder\File;
use VirtualFileSystem\Node\NodeAbstract;
use VirtualFileSystem\Node\NodeInterface;

/**
 * @internal
 */
final class FileTest extends TestCase
{
    /** @var File $file */
    private $file;

    public function setUp(): void
    {
        $this->file = new File('def');
    }

    public function testFileCreate(): void
    {
        $this->assertInstanceOf(NodeInterface::class, $this->file);
        $this->assertInstanceOf(NodeAbstract::class, $this->file);

        $this->assertEquals('def', $this->file->getName());
        $this->assertInstanceOf(DateTime::class, $this->file->getDate());
        $this->assertNull($this->file->getParent());
    }

    public function testFileToArray(): void
    {
        $fileArray = $this->file->toArray();
        $this->assertArrayHasKey('name', $fileArray);
        $this->assertIsString($fileArray['name']);
        $this->assertArrayHasKey('date', $fileArray);
        $this->assertInstanceOf(DateTime::class, $fileArray['date']);
        $this->assertArrayHasKey('isFolder', $fileArray);
        $this->assertIsBool($fileArray['isFolder']);
    }

    public function testSettersGetters(): void
    {
        $this->file->setName('newName');
        $this->assertEquals('newName', $this->file->getName());

        $newDate = new DateTime();
        $this->file->setDate($newDate);
        $this->assertEquals($newDate, $this->file->getDate());
    }
}
