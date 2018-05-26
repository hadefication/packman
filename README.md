# Packman

Just another package generator for [Laravel](https://laravel.com/).

## Installation

Install it by running `composer global require "hadefication/packman"`. Once installed, be sure to place the `$HOME/.composer/vendor/bin` directory (or the equivalent directory for your OS) in your `$PATH` so the packman executable can be located by your system.

## Usage

To generate a new package, just run `packman new your-package-name` or `packman make`. A folder named `yourpackage` should be generated in your current working directory that includes all the necessary files to get you started on developing a [Laravel](https://laravel.com/) package. Check the [official](https://laravel.com/docs/5.4/packages) guide for more details on [Laravel](https://laravel.com/) package development.

For more details on the command, run `packman help new` or `packman help make`.
