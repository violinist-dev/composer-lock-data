# composer-lock-data


[![Packagist](https://img.shields.io/packagist/v/violinist-dev/composer-lock-data.svg?maxAge=3600)](https://packagist.org/packages/violinist-dev/composer-lock-data)
[![Packagist](https://img.shields.io/packagist/dt/violinist-dev/composer-lock-data.svg?maxAge=3600)](https://packagist.org/packages/violinist-dev/composer-lock-data)
[![Build Status](https://travis-ci.org/violinist-dev/composer-lock-data.svg?branch=master)](https://travis-ci.org/violinist-dev/composer-lock-data)

A convenience class to find things in composer.lock files.

## Installation

```
composer require violinist-dev/composer-lock-data
```

## Usage

```php
// Read our own lock file. This is taken from the tests in this very project.
$data = ComposerLockData::createFromFile(__DIR__ . '/../../composer.lock');
$package_data = $data->getPackageData('phpunit/phpunit');
// Package data will now be something like this (example with json print):
print json_encode($package_data, JSON_PRETTY_PRINT);
```

```json
{
    "name": "phpunit\/phpunit",
    "version": "6.5.14",
    "source": {
        "type": "git",
        "url": "https:\/\/github.com\/sebastianbergmann\/phpunit.git",
        "reference": "bac23fe7ff13dbdb461481f706f0e9fe746334b7"
    },
    "dist": {
        "type": "zip",
        "url": "https:\/\/api.github.com\/repos\/sebastianbergmann\/phpunit\/zipball\/bac23fe7ff13dbdb461481f706f0e9fe746334b7",
        "reference": "bac23fe7ff13dbdb461481f706f0e9fe746334b7",
        "shasum": ""
    },
    "require": {
        "ext-dom": "*",
        "ext-json": "*",
        "ext-libxml": "*",
        "ext-mbstring": "*",
        "ext-xml": "*",
        "myclabs\/deep-copy": "^1.6.1",
        "phar-io\/manifest": "^1.0.1",
        "phar-io\/version": "^1.0",
        "php": "^7.0",
        "phpspec\/prophecy": "^1.7",
        "phpunit\/php-code-coverage": "^5.3",
        "phpunit\/php-file-iterator": "^1.4.3",
        "phpunit\/php-text-template": "^1.2.1",
        "phpunit\/php-timer": "^1.0.9",
        "phpunit\/phpunit-mock-objects": "^5.0.9",
        "sebastian\/comparator": "^2.1",
        "sebastian\/diff": "^2.0",
        "sebastian\/environment": "^3.1",
        "sebastian\/exporter": "^3.1",
        "sebastian\/global-state": "^2.0",
        "sebastian\/object-enumerator": "^3.0.3",
        "sebastian\/resource-operations": "^1.0",
        "sebastian\/version": "^2.0.1"
    },
    "conflict": {
        "phpdocumentor\/reflection-docblock": "3.0.2",
        "phpunit\/dbunit": "<3.0"
    },
    "require-dev": {
        "ext-pdo": "*"
    },
    "suggest": {
        "ext-xdebug": "*",
        "phpunit\/php-invoker": "^1.1"
    },
    "bin": [
        "phpunit"
    ],
    "type": "library",
    "extra": {
        "branch-alias": {
            "dev-master": "6.5.x-dev"
        }
    },
    "autoload": {
        "classmap": [
            "src\/"
        ]
    },
    "notification-url": "https:\/\/packagist.org\/downloads\/",
    "license": [
        "BSD-3-Clause"
    ],
    "authors": [
        {
            "name": "Sebastian Bergmann",
            "email": "sebastian@phpunit.de",
            "role": "lead"
        }
    ],
    "description": "The PHP Unit Testing framework.",
    "homepage": "https:\/\/phpunit.de\/",
    "keywords": [
        "phpunit",
        "testing",
        "xunit"
    ],
    "time": "2019-02-01T05:22:47+00:00"
}
```
