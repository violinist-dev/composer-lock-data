<?php

namespace Violinist\ComposerLockData\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Violinist\ComposerLockData\ComposerLockData;

class UnitTest extends TestCase
{
    public function testBasic()
    {
        // Read our own lock file.
        $data = ComposerLockData::createFromFile(__DIR__ . '/../../composer.lock');
        $package_data = $data->getPackageData('phpunit/phpunit');
        $this->assertEquals('phpunit/phpunit', $package_data->name);
    }
}
