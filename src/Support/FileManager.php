<?php

namespace Packman\Support;

class FileManager
{
    protected $path;
    protected $vendor;
    protected $name;

    protected $namespace;
    protected $provider;
    protected $package;

    public function __construct($name, $vendor, $path)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->path = $path;
    }


    public function generate()
    {
        $this->makeSourceDirectory();
        $this->generateComposer();
        $this->generateProvider();
        $this->generateFacade();
        $this->generateHandler();
    }

    public function makeSourceDirectory($name = 'src')
    {
        return mkdir(join('/', [$this->path, $name]));
    }

    public function generateComposer()
    {

        return (new Composer($this->name, $this->vendor))
            ->generateTo($this->path);

    }

    public function generateProvider()
    {
        return (new Provider($this->name, $this->vendor))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    public function generateFacade()
    {
        return (new Facade($this->name, $this->vendor))
            ->generateTo(join('/', [$this->path, 'src']));
    }

    public function generateHandler()
    {
        return (new Handler($this->name, $this->vendor))
            ->generateTo(join('/', [$this->path, 'src']));
    }
}
