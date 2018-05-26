<?php

namespace Hadefication\Packman\Support;

class Facade extends Generator
{
    /**
     * Facade container
     *
     * @var string
     */
    protected $facade;

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
    protected function initialize()
    {
        $this->namespace = join('\\', [ucfirst($this->vendor), Helper::studlyCase($this->name)]);
        $this->facade = Helper::studlyCase($this->name) . "Facade";
    }

    /**
     * Generate facade to the supplied path
     *
     * @param  string $path the path where the facade will be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, "{$this->facade}.php"]), $this->getStub());
    }

    /**
     * Get variables that will be parsed with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [
            'name' => Helper::flatCase($this->name),
            'namespace' => $this->namespace,
            'facade' => $this->facade
        ];
    }

    /**
     * Get the facade's stub/template and parse all variables in it
     *
     * @return string
     */
    public function getStub()
    {
        return Helper::parseStub(dirname(__DIR__).'/Stubs/facade.txt', $this->getVars());
    }
}
