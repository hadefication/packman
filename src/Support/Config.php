<?php

namespace Hadefication\Packman\Support;

class Config extends Generator
{
    /**
     * Config name container
     *
     * @var string
     */
    protected $config;

    /**
     * Initialize
     *
     * @return void
     */
    protected function initialize()
    {
        $this->config = Helper::flatCase($this->name);
    }

    /**
     * Generate facade to the supplied path
     *
     * @param  string $path the path where the facade will be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, "config.php"]), $this->getStub());
    }

    /**
     * Get variables that will be parsed with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [];
    }

    /**
     * Get the facade's stub/template and parse all variables in it
     *
     * @return string
     */
    public function getStub()
    {   
        return <<<EOT
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Hello
    |--------------------------------------------------------------------------
    |
    | This value is a sample entry to your package config. Access it via config
    | helper function like config('{$this->config}.hello') or 
    | config()->get('{$this->config}.hello')
    */
    'hello' => 'World',

    // 

];
EOT;
    }
}
