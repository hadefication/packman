<?php

namespace Packman\Support;

class Handler extends Generator
{

    /**
     * Namespace container
     *
     * @var string
     */
    protected $namespace;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->namespace = join('\\', [ucfirst($this->vendor), ucfirst($this->name)]);
    }

    /**
     * Generate handler class to the supplied path
     *
     * @param  string $path the path where the handler class will be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, ucfirst($this->name).".php"]), $this->getStub());
    }

    /**
     * Get the variables to be parsed in with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [
            'name' => ucfirst($this->name),
            'namespace' => $this->namespace,
        ];
    }

    /**
     * Get the handles stub/template and parse all variables in it
     *
     * @return string
     */
    public function getStub()
    {
        $stub = file_get_contents(dirname(__DIR__).'/Stubs/handler.txt');
        foreach($this->getVars() as $key => $value) {
            $stub = preg_replace("/\{$key\}/i", $value, $stub);
        }
        return $stub;
    }
}
