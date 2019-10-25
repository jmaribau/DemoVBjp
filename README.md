## Description
Virtual file system, with folders and files

## Requirements
````
php ^7.2
phpunit ^8.4
````

## Install
````
$ git clone https://github.com/jmaribau/DemoVBjp.git
$ cd DemoVBjp
$ composer install
````

## Use
`$ php part1.php`

## Part1.php
### Code
````
<?php

declare(strict_types=1);

namespace VirtualFileSystem;

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
echo $view->render()
````

### Result
````
$ php part1.php

Home > MyProject

Name / Created / Directory
--------------------------

. / 2019-10-21 11:54:09 / 1
.. / 2019-10-21 11:54:09 / 1
images / 2019-10-21 11:54:09 / 1
src / 2019-10-21 11:54:09 / 1
tests / 2019-10-21 11:54:09 / 1
README.md / 2019-10-21 11:54:09 / 0



Home > MyProject > images

Name / Created / Directory
--------------------------

. / 2019-10-21 11:54:09 / 1
.. / 2019-10-21 11:54:09 / 1
main_logo.png / 2019-10-21 11:54:09 / 0
main_small.png / 2019-10-21 11:54:09 / 0
icons.png / 2019-10-21 11:54:09 / 0
````

## Test
Type `$ composer tests`
````
λ composer test
> php vendor/phpunit/phpunit/phpunit tests/
PHPUnit 8.4.1 by Sebastian Bergmann and contributors.

......                                                              6 / 6 (100%)

Time: 234 ms, Memory: 4.00 MB

OK (6 tests, 24 assertions)
````

## Quality Tools

#### PHPLint
Type `$ composer qa-phpint`
````
$ composer qa-phplint
> php vendor/overtrue/phplint/bin/phplint src/ tests/ -c build/.phplint.yml
phplint 1.0.2 by overtrue and contributors.

Loaded config from "build/.phplint.yml"

....

Time: < 1 sec   Memory: 0 B     Cache: Yes

OK! (Files: 9, Success: 9)
````

#### PHPCodeSniffer
Type `$ composer qa-phpcs`
````
$ composer qa-phpcs
> php vendor/squizlabs/php_codesniffer/bin/phpcs src/ tests/ -p --colors --cache --standard=PSR1,PSR2
......... 9 / 9 (100%)


Time: 568ms; Memory: 6MB
````
#### PHPCodeStandardFixer
Type `$ composer qa-phcsf`
````
$ composer qa-phpcsf
> php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache
Loaded config default.
Using cache file "build/.php_cs.cache".
SS
Checked all files in 0.005 seconds, 10.000 MB memory used
SSSSS
Legend: ?-unknown, I-invalid file syntax, file ignored, S-Skipped, .-no changes, F-fixed, E-error
> php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache
Loaded config default.
Using cache file "build/.php_cs.cache".

SChecked all files in 0.010 seconds, 10.000 MB memory used
S
Legend: ?-unknown, I-invalid file syntax, file ignored, S-Skipped, .-no changes, F-fixed, E-error
````

#### PHPStan
Type `$ composer qa-phpstan`
````
$ composer qa-phpstan
> php vendor/phpstan/phpstan/bin/phpstan analyse src/ --level 7

 7/7 [============================] 100%
                                                                                                                         7/7 [============================] 100%
 [OK] No errors
````

#### PHPMessDetector
Type `$ composer qa-phpmd`
````
$ composer qa-phpmd
> php vendor/phpmd/phpmd/src/bin/phpmd src/ text build/phpmd.xml
````

#### PHPCopyPasteDetector
Type `$ composer qa-phpcpd`
````
$ composer qa-phpcpd
> php vendor/sebastian/phpcpd/phpcpd src/ --min-lines 5 --min-tokens 70
phpcpd 4.1.0 by Sebastian Bergmann.

No clones found.

Time: 69 ms, Memory: 4.00 MB
````

## Composer

#### Required
````
"require": {
        "php": "^7.2"
    },
    "require-dev": {
        "phpunit/phpunit": "^8.4",
        "overtrue/phplint": "^1.1",
        "squizlabs/php_codesniffer": "^3.5",
        "friendsofphp/php-cs-fixer": "^2.15",
        "phpstan/phpstan": "^0.11.16",
        "phpmd/phpmd": "^2.7",
        "sebastian/phpcpd": "^4.1",
        "symfony/var-dumper": "^4.3"
    },
    "autoload": {
        "psr-4": {
            "VirtualFileSystem\\": "src/"
        }
    },
````
#### Scripts
````
"scripts": {
        "tests": "php vendor/phpunit/phpunit/phpunit tests/",
        "tests-show": "php vendor/phpunit/phpunit/phpunit tests/ --testdox","

        "qa1": ["@qa-phplint", "@qa-phpstan", "@qa-phpmd", "@qa-phpcpd"],
        "qa2": ["@qa-phpcs", "@qa-phpcsf"],
        "qa3": ["@qa-phpcbf", "@qa-phpcsf-force"],

        "qa-phplint" : "php vendor/overtrue/phplint/bin/phplint src/ tests/ -c build/.phplint.yml",
        "qa-phpcs" : "php vendor/squizlabs/php_codesniffer/bin/phpcs src/ tests/ -p --colors --cache --standard=PSR1,PSR2",
        "qa-phpcbf": "php vendor/squizlabs/php_codesniffer/bin/phpcbf src/ tests/ --standard=PSR1,PSR2",
        "qa-phpcsf": [
            "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache",
            "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --dry-run --diff --cache-file build/.php_cs.cache"
        ],
      "qa-phpcsf-force": [
        "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --cache-file build/.php_cs.cache",
        "php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests/ -v --rules=@PSR1,@PSR2,@PhpCsFixer --cache-file build/.php_cs.cache"
      ],
        "qa-phpstan" : "php vendor/phpstan/phpstan/bin/phpstan analyse src/ --level 7",
        "qa-phpmd" : [
            "php vendor/phpmd/phpmd/src/bin/phpmd src/ text build/phpmd.xml"
        ],
        "qa-phpcpd" : "php vendor/sebastian/phpcpd/phpcpd src/ --min-lines 5 --min-tokens 70"
    }
````