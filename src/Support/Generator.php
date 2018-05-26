<?php

namespace Hadefication\Packman\Support;

abstract class Generator
{

    /**
     * Package's name container
     *
     * @var string
     */
    protected $name;

    /**
     * Vendor name container
     *
     * @var string
     */
    protected $vendor;

    /**
     * Basic mode container
     *
     * @var bool
     */
    protected $basic;
    

    /**
     * Constructor
     *
     * @param string $name                      the package's name
     * @param string $vendor                    the package's vendor
     * @param boolean $basic                    flag to only generate basic files
     */
    public function __construct($name, $vendor, $basic = false)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->basic = $basic;

        // Fire post initialization hook!
        $this->initialize();
    }

    /**
     * Post initialization hook, add custom setters here.
     *
     * @return void
     */
    abstract protected function initialize();

    /**
     * Generate file to the supplied path
     *
     * @param  string $path                     the path where the generated file to drop in
     * @return boolean
     */
    abstract public function generateTo($path);

    /**
     * Get stub/template
     *
     * @return string
     */
    abstract public function getStub();

    /**
     * Get the variables to be parsed in with the template
     *
     * @return array
     */
    abstract public function getVars();

}
