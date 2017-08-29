<?php

namespace Packman\Support;

class Provider
{

    protected $name;
    protected $vendor;
    protected $provider;
    protected $namespace;

    public function __construct($name, $vendor)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->namespace = join('\\', [ucfirst($vendor), ucfirst($name)]);
        $this->provider = ucfirst($name) . "ServiceProvider";
    }

    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, "{$this->provider}.php"]), $this->getStub());
    }

    protected function getVars()
    {
        return [
            'name' => $this->name,
            'namespace' => $this->namespace,
            'provider' => $this->provider
        ];
    }

    protected function getStub()
    {
        $stub = file_get_contents(dirname(__DIR__).'/stubs/provider.txt');
        foreach($this->getVars() as $key => $value) {
            $stub = preg_replace("/\{$key\}/i", $value, $stub);
        }
        return $stub;
    }
}
