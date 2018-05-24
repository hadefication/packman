<?php

namespace Hadefication\Packman\Support;

class FileManager
{

    /**
     * Path container
     *
     * @var string
     */
    protected $path;

    /**
     * Vendor's name container
     *
     * @var string
     */
    protected $vendor;

    /**
     * Package's name container
     *
     * @var string
     */
    protected $name;

    /**
     * Constructor
     *
     * @param string $name                      the package's name
     * @param string $vendor                    the vendor's name
     * @param string $path                      the path where the package files will be generated
     */
    public function __construct($name, $vendor, $path)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->path = $path;
    }

    /**
     * Generate package files
     *
     * @return void
     */
    public function generate()
    {
        $this->makeSourceDirectory();
        $this->generateComposer();
        $this->generateProvider();
        $this->generateFacade();
        $this->generateHandler();
    }

    /**
     * Make the source directory
     *
     * @param  string $name                     the name of the directory to make, defaults to src
     * @return boolean
     */
    public function makeSourceDirectory($name = 'src')
    {
        return mkdir(join('/', [$this->path, $name]));
    }

    /**
     * Generate composer file
     *
     * @return boolean
     */
    public function generateComposer()
    {
        return (new Composer($this->name, $this->vendor))
            ->generateTo($this->path);
    }

    /**
     * Generate service provider class
     *
     * @return boolean
     */
    public function generateProvider()
    {
        return (new Provider($this->name, $this->vendor))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    /**
     * Generate facade class
     *
     * @return boolean
     */
    public function generateFacade()
    {
        return (new Facade($this->name, $this->vendor))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    /**
     * Generate handler class
     *
     * @return boolean
     */
    public function generateHandler()
    {
        return (new Handler($this->name, $this->vendor))
            ->generateTo(join('/', [$this->path, 'src']));
    }
}
