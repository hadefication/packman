<?php

namespace Packman\Support;

class Composer
{
    protected $package;
    protected $namespace;

    public function __construct($name, $vendor)
    {
        $this->package = join('/', [$vendor, $name]);
        $this->namespace = join('\\\\', [ucfirst($vendor), ucfirst($name), '']);
        $this->provider = join('', [$this->namespace, ucfirst($name) . 'ServiceProvider']);
    }

    protected function getStub()
    {
        return [
            "name" => $this->package,
            "description" => "Your package description here",
            "license" => "MIT",
            "require" => [
                "illuminate/support" => "^5.4"
            ],
            "autoload" => [
                "psr-4" => [
                    $this->namespace => "src/"
                ]
            ],
            "minimum-stability": "dev",
            "prefer-stable": true,
            "extra" => [
                "laravel" => [
                    "providers" => [
                        $this->provider
                    ]
                ]
            ]
        ];
    }

    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, 'composer.json']), stripslashes(json_encode($this->getStub(), JSON_PRETTY_PRINT)));
    }
}
