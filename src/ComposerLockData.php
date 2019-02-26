<?php

namespace Violinist\ComposerLockData;

class ComposerLockData
{
    private $data;

    public function setData($json)
    {
        $this->data = $json;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getPackageData($package_name)
    {
        $lockfile_key = 'packages';
        $key = $this->getPackagesKey($package_name, $lockfile_key, $this->data);
        if ($key === false) {
            // Well, could be a dev req.
            $lockfile_key = 'packages-dev';
            $key = $this->getPackagesKey($package_name, $lockfile_key, $this->data);
            // If the key still is false, then this is not looking so good.
            if (false === $key) {
                throw new \Exception(
                    sprintf(
                        'Did not find the requested package (%s) in the lockfile. This is probably an error',
                        $package_name
                    )
                );
            }
        }
        return $this->data->{$lockfile_key}[$key];
    }

    public function getPackagesKey($package_name, $lockfile_key, $lockdata)
    {
        $names = array_column($lockdata->{$lockfile_key}, 'name');
        return array_search($package_name, $names);
    }

    public static function createFromFile($filepath)
    {
        if (!$data = @file_get_contents($filepath)) {
            throw new \InvalidArgumentException('No composer.lock data at filepath ' . $filepath);
        }
        return self::createFromString($data);
    }

    public static function createFromString($data)
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('The supposed composer.lock data was empty');
        }
        if (!$json = @json_decode($data)) {
            throw new \InvalidArgumentException('The data provided was not valid JSON');
        }
        $self = new static();
        $self->setData($json);
        return $self;
    }
}
