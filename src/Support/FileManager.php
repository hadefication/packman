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
     * Basic files flag
     *
     * @var boolean
     */
    protected $basic = false;

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

    public function onlyBasicFiles($basic)
    {
        $this->basic = $basic;
        return $this;
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

        if (! $this->basic) {
            $this->generateTests();
            $this->generateConfig();
            $this->generateView();
            $this->generateTranslations();
        }
    }

    /**
     * Make the source directory
     *
     * @param  string $name                     the name of the directory to make, defaults to src
     * @return boolean
     */
    public function makeSourceDirectory()
    {
        return mkdir(join('/', [$this->path, 'src']));
    }

    public function generateTests()
    {
        mkdir(join('/', [$this->path, 'tests']));
        return (new TestCase($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'tests']));
    }

    public function generateConfig()
    {
        return (new Config($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    public function generateView()
    {
        mkdir(join('/', [$this->path, 'src', 'views']));
        return (new View($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'src', 'views']));
    }

    public function generateTranslations()
    {
        mkdir(join('/', [$this->path, 'src', 'translations']));
        return (new Lang($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'src', 'translations']));
    }

    /**
     * Generate composer file
     *
     * @return boolean
     */
    public function generateComposer()
    {
        return (new Composer($this->name, $this->vendor, $this->basic))
            ->generateTo($this->path);
    }

    /**
     * Generate service provider class
     *
     * @return boolean
     */
    public function generateProvider()
    {
        return (new Provider($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    /**
     * Generate facade class
     *
     * @return boolean
     */
    public function generateFacade()
    {
        return (new Facade($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    /**
     * Generate handler class
     *
     * @return boolean
     */
    public function generateHandler()
    {
        return (new Handler($this->name, $this->vendor, $this->basic))
            ->generateTo(join('/', [$this->path, 'src']));
    }
}
