<?php

namespace Packman\Support;

class Facade
{

    protected $name;
    protected $vendor;
    protected $facade;
    protected $namespace;

    public function __construct($name, $vendor)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->namespace = join('\\', [ucfirst($vendor), ucfirst($name)]);
        $this->facade = ucfirst($name) . "Facade";
    }

    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, "{$this->facade}.php"]), $this->getStub());
    }

    protected function getVars()
    {
        return [
            'name' => $this->name,
            'namespace' => $this->namespace,
            'facade' => $this->facade
        ];
    }

    protected function getStub()
    {
        $stub = file_get_contents(dirname(__DIR__).'/stubs/facade.txt');
        foreach($this->getVars() as $key => $value) {
            $stub = preg_replace("/\{$key\}/i", $value, $stub);
        }
        return $stub;
    }
}
