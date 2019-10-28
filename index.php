<?php

declare(strict_types=1);

namespace VirtualFileSystem;

use VirtualFileSystem\Folder\Folder;
use VirtualFileSystem\Folder\File;
use VirtualFileSystem\View\View;

require __DIR__ . '/vendor/autoload.php';

$home = new Folder('Home');

$home
    ->addChild($myProject = new Folder('MyProject'));

$myProject
    ->addChild($images = new Folder('images'))
    ->addChild(new Folder('src'))
    ->addChild(new Folder('tests'))
    ->addChild(new File('README.md'));

$images
    ->addChild(new File('main_logo.png'))
    ->addChild(new File('main_small.png'))
    ->addChild(new File('icons.png'));

$view = new View($myProject);
echo $view->render();

$view->setFolder($images);
echo $view->render();
