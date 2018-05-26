<?php

namespace Hadefication\Packman\Support;

class TestCase extends Generator
{

    /**
     * Initialize
     *
     * @return void
     */
    protected function initialize()
    {
        // 
    }

    /**
     * Generate facade to the supplied path
     *
     * @param  string $path the path where the facade will be generated
     * @return boolean
     */
    public function generateTo($path)
    {
        return file_put_contents(join('/', [$path, "TestCase.php"]), $this->getStub());
    }

    /**
     * Get variables that will be parsed with the template/stub
     *
     * @return array
     */
    public function getVars()
    {
        return [
            'vendor' => Helper::studlyCase($this->vendor),
            'package' => Helper::studlyCase($this->name),
            'provider' => Helper::studlyCase($this->name) . 'ServiceProvider',
            'facade' => Helper::studlyCase($this->name) . 'Facade'
        ];
    }

    /**
     * Get the facade's stub/template and parse all variables in it
     *
     * @return string
     */
    public function getStub()
    {
        return Helper::parseStub(dirname(__DIR__).'/Stubs/test_case.txt', $this->getVars());
    }
}
