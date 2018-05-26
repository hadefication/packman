<?php

namespace Hadefication\Packman\Support;

class Composer extends Generator
{

    /**
     * Package name container
     *
     * @var string
     */
    protected $package;

    /**
     * Namespace container
     *
     * @var string
     */
    protected $namespace;

    /**
     * Provider name container
     *
     * @var string
     */
    protected $provider;

    protected $alias;

    /**
     * Make
     *
     */
    protected function initialize()
    {
        $this->package = join('/', [$this->vendor, $this->name]);
        $this->namespace = join('\\\\', [Helper::studlyCase($this->vendor), Helper::studlyCase($this->name), '']);
        $this->provider = join('', [$this->namespace, Helper::studlyCase($this->name) . 'ServiceProvider']);
        $this->alias = Helper::studlyCase($this->name);
        $this->facade = join('\\\\', [Helper::studlyCase($this->vendor), Helper::studlyCase($this->name), Helper::studlyCase($this->name) . 'Facade']);
        $this->testNamespace = join('\\\\', [Helper::studlyCase($this->vendor), 'Tests', '']);
    }

    /**
     * Get the variable to parsed with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [];
    }

    /**
     * Get the composer template/stub
     *
     * @return string
     */
    public function getStub()
    {
        return stripslashes(json_encode([
            "name" => Helper::lowerCase($this->package),
            "description" => "Your package description here",
            "keywords" => [],
            "authors" => [],
            "license" => "MIT",
            "require" => [
                "laravel/framework" => "~5.6.7"
            ],
            "require-dev" => [
                "orchestra/testbench" => "~3.0"
            ],
            "autoload" => [
                "psr-4" => [
                    $this->namespace => "src/"
                ]
            ],
            "autoload-dev" => [
                "psr-4" => [
                    $this->testNamespace => "tests/"
                ]
            ],
            "minimum-stability" => "dev",
            "prefer-stable" => true,
            "extra" => [
                "laravel" => [
                    "providers" => [
                        $this->provider
                    ],
                    "aliases" => [
                        $this->alias => $this->facade
                    ]
                ],
                "packman" => true
            ]
        ], JSON_PRETTY_PRINT));
    }

    /**
     * Generate composer file to the supplied path
     *
     * @param  string $path the path where the composer file to be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, 'composer.json']), $this->getStub());
    }
}
