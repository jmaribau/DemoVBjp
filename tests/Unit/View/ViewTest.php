<?php

declare(strict_types=1);

namespace VirtualFileSystem\Tests;

use PHPUnit\Framework\TestCase;
use VirtualFileSystem\Folder\Folder;
use VirtualFileSystem\View\View;

/**
 * @internal
 */
final class ViewTest extends TestCase
{
    /** @var View $view */
    private $view;

    public function setUp(): void
    {
        $this->view = new View(new Folder('new'));
    }

    public function testSettersGetters(): void
    {
        $this->view->setTemplate('new_template.php');
        $this->assertEquals('new_template.php', $this->view->getTemplate());

        $folder = new Folder('new');
        $this->view->setFolder($folder);
        $this->assertEquals($folder, $this->view->getFolder());

    }
}
