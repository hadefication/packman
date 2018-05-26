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
        $this->namespace = join('\\', [Helper::studlyCase($this->vendor), Helper::studlyCase($this->name)]);
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
        $providerRegisterArgs = Helper::parseStub(dirname(__DIR__).'/Stubs/provider_register.txt', [
            'name' => Helper::flatCase($this->name, '_')
        ]);

        $providerBootArgs = Helper::parseStub(dirname(__DIR__).'/Stubs/provider_boot.txt', [
            'name' => Helper::flatCase($this->name, '_')
        ]);

        if ($this->basic) {
            $providerBootArgs = "\t\t// ";
            $providerRegisterArgs = "\t\t// ";
        }
        
        return [
            'name' => Helper::flatCase($this->name),
            'pascal_name' => Helper::studlyCase($this->name),
            'namespace' => $this->namespace,
            'provider' => $this->provider,
            'boot' => $providerBootArgs,
            'register' => $providerRegisterArgs
        ];
    }

    /**
     * Get the providers stub/template and parse all variables in it
     *
     * @return string 
     */
    public function getStub()
    {
        return Helper::parseStub(dirname(__DIR__).'/Stubs/provider.txt', $this->getVars());
    }
}
