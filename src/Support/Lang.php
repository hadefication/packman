<?php

namespace Hadefication\Packman\Support;

class Lang extends Generator
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
        return file_put_contents(join('/', [$path, "message.php"]), $this->getStub());
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
    | Message Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by this package for various messages 
    | that needs to be displayed to the user. You are free to modify these 
    | language lines according to your application's requirements.
    |
    */

    'hello' => 'Hello!',
    'world' => 'Cold world!',

    // 

];
EOT;
    }
}
