# TYPO3 Requirements Check

## What is this repository for?

TYPO3 has quite a few requirements to run properly. There are mandatory PHP modules
and other optional, but very recommended software enhancements, like the support for
ImageMagick/GraphicsMagick and so on.

To ease the pain of creating the right environment for your TYPO3 project, the TYPO3
install tool provides checks that you can run, once TYPO3 is installed. That is quite
handy but what if you want to check if your server is prepared **before** you want to
install TYPO3 or you installed TYPO3 and you can't open the install tool because some
requirements aren't met?

Well, this repository is the solution to that problem.

## How does it work

Actually this repository is just a ver small `symfony/console` application that has
a dependency on the TYPO3 install tool package. After cloning/downloading this
repository you need **composer** to install that depency. All the checks are taken
from the original TYPO3 repository but they are executed on the command line so
you don't need a running TYPO3 instance.

## How to install?

- `git clone --branch TYPO3_X-Y https://github.com/alexanderschnitzler/typo3-requirements-check.git`
- `cd typo3-requirements-check`
- `composer install --no-dev --no-plugins`

### Why the --no-plugins option?

That's because the `typo3/cms-install` package has a dependency on `typo3/cms-core`
which comes with a composer plugin that creates a ready-to-run TYPO3 instance with
an `index.php` symlink, a `typo3` folder and so on, hence the `--no-plugins` option.

## How to run the checks?

`/usr/bin/env php check.php`

## Why is the master branch empty?

Because to support all current LTS versions and upcoming sprint releases, it is easiest
to work with branches. Currently, the following branches are available:

* [TYPO3_8-7](https://github.com/alexanderschnitzler/typo3-requirements-check/tree/TYPO3_8-7)
* [TYPO3_9-0](https://github.com/alexanderschnitzler/typo3-requirements-check/tree/TYPO3_9-0)
* [TYPO3_9-1](https://github.com/alexanderschnitzler/typo3-requirements-check/tree/TYPO3_9-1)

## License
GPLv2
