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

    public function testInvalidPackage()
    {
        $data = ComposerLockData::createFromFile(__DIR__ . '/../../composer.lock');
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Did not find the requested package (derp/error) in the lockfile. This is probably an error');
        $data->getPackageData('derp/error');
    }

    public function testInvalidPath()
    {
        $path = __DIR__ . '/../../composer-non-existing.lock';
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No composer.lock data at filepath ' . $path);
        $data = ComposerLockData::createFromFile($path);
    }

    public function testEmptyJson()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The supposed composer.lock data was empty');
        ComposerLockData::createFromString('');
    }

    public function testBadJson()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The data provided was not valid JSON');
        ComposerLockData::createFromString('{bad_json: true');
    }

    public function testGetData()
    {
        $cdata = ComposerLockData::createFromFile(__DIR__ . '/../../composer.lock');
        $data = $cdata->getData();
        $this->assertEquals('stable', $data->{"minimum-stability"});
    }
}
