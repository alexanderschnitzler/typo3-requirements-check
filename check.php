<?php
declare(strict_types=1);

use Symfony\Component\Console\Application;
use Schnitzler\TYPO3RequirementsCheck\Command\CheckCommand;

require_once __DIR__ . '/vendor/autoload.php';
define('LF', PHP_EOL);

$application = new Application();
$application->add(new CheckCommand());
$application->setDefaultCommand('check');
$application->run();
