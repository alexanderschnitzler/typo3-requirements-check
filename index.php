<?php
use Symfony\Component\Console\Application;
use TYPO3\CMS\Install\Command\CheckCommand;

require_once __DIR__ . '/vendor/autoload.php';
define('LF', PHP_EOL);

$application = new Application();
$application->add(new CheckCommand());
$application->run();
