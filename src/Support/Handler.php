<?php

namespace Hadefication\Packman\Support;

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
        $this->namespace = join('\\', [Helper::studlyCase($this->vendor), Helper::studlyCase($this->name)]);
    }

    /**
     * Generate handler class to the supplied path
     *
     * @param  string $path the path where the handler class will be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, Helper::studlyCase($this->name).".php"]), $this->getStub());
    }

    /**
     * Get the variables to be parsed in with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [
            'name' => Helper::studlyCase($this->name),
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
        return Helper::parseStub(dirname(__DIR__).'/Stubs/handler.txt', $this->getVars());
    }
}
