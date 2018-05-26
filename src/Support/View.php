<?php

namespace Hadefication\Packman\Support;

class View extends Generator
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
        return file_put_contents(join('/', [$path, "hello.blade.php"]), $this->getStub());
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
<h1>{{ trans('hello') }} {{ trans('world') }}</h1>
EOT;
    }
}
