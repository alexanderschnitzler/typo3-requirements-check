<?php
declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
namespace Schnitzler\TYPO3RequirementsCheck\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Install\Status\StatusInterface;
use TYPO3\CMS\Install\SystemEnvironment\Check;

/**
 * Class Schnitzler\TYPO3RequirementsCheck\Command\CheckCommand
 */
class CheckCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('check');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $statuus = (new Check())->getStatus();

        $dots = [];
        $oks = [];
        $warnings = [];
        $errors = [];
        foreach ($statuus as $status) {
            /** @var StatusInterface $status */

            switch ($status->getSeverity()) {
                case 'notice':
                    $dots[] = '<info>.</info>';
                    $oks[] = $status->getTitle();
                    break;
                case 'information':
                    $dots[] = '<info>.</info>';
                    $oks[] = $status->getTitle();
                    break;
                case 'ok':
                    $dots[] = '<info>.</info>';
                    $oks[] = $status->getTitle();
                    break;
                case 'warning':
                    $dots[] = '<comment>W</comment>';
                    $warnings[] = $status->getTitle();
                    break;
                case 'error':
                    $dots[] = '<error>E</error>';
                    $errors[] = $status->getTitle();
                    break;
                case 'alert':
                    $dots[] = '<error>E</error>';
                    $errors[] = $status->getTitle();
                    break;
                default:
                    break;
            }
        }

        /** @var FormatterHelper $formatter */
        $formatter = $this->getHelper('formatter');

        $output->writeln('');
        $output->writeln('> PHP is using the following php.ini file:');
        $output->writeln('  <info>' . get_cfg_var('cfg_file_path') . '</info>');
        $output->writeln('');

        $output->writeln('> Checking TYPO3 requirements:');
        $output->writeln('  ' . implode('', $dots));
        $output->writeln('');

        if (count($errors) > 0) {
            $output->writeln($formatter->formatSection('Errors', '', 'error'));
            $output->writeln($formatter->formatBlock($errors, 'error'));
            $output->writeln('');
        }

        if (count($warnings) > 0) {
            $output->writeln($formatter->formatSection('Warning', '', 'comment'));
            $output->writeln($formatter->formatBlock($warnings, 'comment'));
            $output->writeln('');
        }

        if (count($oks) > 0) {
            $output->writeln($formatter->formatSection('OK', '', 'info'));
            $output->writeln($formatter->formatBlock($oks, 'info'));
        }

        return 0;
    }
}
