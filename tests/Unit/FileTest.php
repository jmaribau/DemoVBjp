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
 * @covers \File
 */
final class FileTest extends TestCase
{
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
}
