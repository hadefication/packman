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

    /**
     * Make
     *
     */
    protected function initialize()
    {
        $this->package = join('/', [$this->vendor, $this->name]);
        $this->namespace = join('\\\\', [Helper::studlyCase($this->vendor), Helper::studlyCase($this->name), '']);
        $this->provider = join('', [$this->namespace, Helper::studlyCase($this->name) . 'ServiceProvider']);
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
            "name" => strtolower($this->package),
            "description" => "Your package description here",
            "license" => "MIT",
            "require" => [
                "illuminate/support" => "^5.6"
            ],
            "autoload" => [
                "psr-4" => [
                    $this->namespace => "src/"
                ]
            ],
            "require-dev" => [
                "orchestra/testbench" => "~3.0"
            ],
            "minimum-stability" => "dev",
            "prefer-stable" => true,
            "extra" => [
                "laravel" => [
                    "providers" => [
                        $this->provider
                    ]
                ]
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
