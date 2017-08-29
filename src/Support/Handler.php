<?php

namespace Packman\Support;

class Handler
{

    protected $name;
    protected $vendor;
    protected $namespace;

    public function __construct($name, $vendor)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->namespace = join('\\', [ucfirst($vendor), ucfirst($name)]);
    }

    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, ucfirst($this->name).".php"]), $this->getStub());
    }

    protected function getVars()
    {
        return [
            'name' => ucfirst($this->name),
            'namespace' => $this->namespace,
        ];
    }

    protected function getStub()
    {
        $stub = file_get_contents(dirname(__DIR__).'/stubs/handler.txt');
        foreach($this->getVars() as $key => $value) {
            $stub = preg_replace("/\{$key\}/i", $value, $stub);
        }
        return $stub;
    }
}
