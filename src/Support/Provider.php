<?php

namespace Hadefication\Packman\Support;

class Provider extends Generator
{

    /**
     * Provider container
     *
     * @var string
     */
    protected $provider;

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
        $this->provider = Helper::studlyCase($this->name) . "ServiceProvider";
    }

    /**
     * Generate provider file to the supplied path
     *
     * @param  string $path the path where the provider file will be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, "{$this->provider}.php"]), $this->getStub());
    }

    /**
     * Get the variables that will be parsed with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [
            'name' => Helper::camelCase($this->name),
            'pascal_name' => Helper::studlyCase($this->name),
            'namespace' => $this->namespace,
            'provider' => $this->provider
        ];
    }

    /**
     * Get the providers stub/template and parse all variables in it
     *
     * @return string 
     */
    public function getStub()
    {
        $stub = file_get_contents(dirname(__DIR__).'/Stubs/provider.txt');
        foreach($this->getVars() as $key => $value) {
            $stub = preg_replace("/\{$key\}/i", $value, $stub);
        }
        return $stub;
    }
}
