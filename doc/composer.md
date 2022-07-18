Composer
========

Composer is a [package manager](https://en.wikipedia.org/wiki/Package_manager) for PHP, also call dependency manager.
It is used to automate the process of installing a project dependencies. When your are building your PHP project, you
may use some code (dependencies) that not yours but that will prevent you to reinvent the wheel.

Composer work with a `composer.json` file in the root project directory. It save the list of all the dependencies needed
to run AND dev your project. There is also a secondary file `composer.lock`, this one save the exact version installed
for your project.

## `composer.json` file

**!!! WARNING !!!**, I will use JS comments in the JSON example but JSON **DOES NOT** support comments.

```json
{
    // The name of your project.
    "name": "hb/todolist-composer",
    // A small description for your project.
    "description": "An example of a todolist using composer and PHP",
    // Your project's type: project | library | metapackage | composer-plugin | symfony-bundle | etc...
    "type": "project",
    // The license for your project.
    "license": "MIT",
    // Config for PHP's autoloader.
    "autoload": {
        // Use PSR-4 autoload for namespace 'Hb\TodolistComposer\' on directory 'src'.
        "psr-4": {
            "Hb\\TodolistComposer\\": "src/"
        }
    },
    // List of dependencies.
    "require": {
        "twig/twig": "^3.4",
        "symfony/routing": "^6.0"
    },
    // List of dependencies useful only for development.
    "require-dev": {
        "symfony/var-dumper": "^6.0"
    }
}

```

You can create this file with the command `composer init` when you create a new project. Just answer asked questions.

## Set versions

Composer follow [semantic version](https://semver.org/) specs.
To see detailed info about version setting, look [this doc](https://getcomposer.org/doc/articles/versions.md).

Here some examples:

| Version set | Min installable | Max installable |
|-------------|----------------:|----------------:|
| 1.2.3 | 1.2.3 | 1.2.3 |
| >=1.2.3 | 1.2.3 | all after |
| <1.2.3 | all bellow | 1.2.2 |
| 1.2.* | 1.2.0 | 1.3.0 excluded |
| ~1.2.3 | 1.2.3 | 1.3.0 excluded |
| ~1.2 | 1.2.0 | 2.0.0 excluded |
| ^1.2.3 | 1.2.3 | 2.0.0 excluded |
| ^0.2.3 | 0.2.3 | 0.3.0 excluded |

## Install composer on your machine

You have to do this install ONLY once per machine. Follow instructions on the [official doc](https://getcomposer.org/download/).

## Cheatsheet

| Command | Description |
|---------|-------------|
| `composer install` | Installs all dependencies founded in the `composer.lock` file. If `composer.lock` file does not exist, use `composer.json` instead and create the `composer.lock` file. |
| `composer update` | Updates all dependencies|
| `composer update vendor/package` | Update `vendor/package` only |
| `composer update vendor/*` | Updates all dependencies of `vendor` |
| `composer require vendor/package` | Add `vendor/package` to `composer.json` and install it (+ update `composer.lock` file) |
| `composer require vendor/package --dev` | Same as above but added in dev dependency |
| `composer require vendor/package "version"` | Require a dependency with a specific version (or version pattern) |
