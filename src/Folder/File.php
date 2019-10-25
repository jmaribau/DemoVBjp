<?php

declare(strict_types=1);

namespace VirtualFileSystem\Folder;

use VirtualFileSystem\Node\NodeAbstract;

/**
 * Class File.
 */
class File extends NodeAbstract
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'date' => $this->getDate(),
            'isFolder' => false,
        ];
    }
}
