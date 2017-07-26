<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * Class CleanCss
 *
 * @author EBs
 * @package App\Console\Commands
 */
class CleanCss extends Command
{
    /**
     * @author EB
     * @var string
     */
    protected $signature = 'clean:css';

    /**
     * @author EB
     * @var string
     */
    protected $description = 'Clean up all computed CSS files that mix has created';

    /**
     * @author EB
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @author EB
     */
    public function handle()
    {
        $files = $this->getFiles();

        $this->line('Removing computed CSS files [' . implode(',', $files) . ']');

        foreach ($files as $file) {
            $process = new Process('rm -rf ' . $file . '.*.js', 'public/css/');
            $process->run();
        }

        $this->info('Successfully removed CSS files');
    }

    /**
     * @author EB
     * @return array
     */
    private function getFiles()
    {
        $process = new Process('ls *.*.css | awk -F \'[.]\' \'{print $1}\' | paste -sd \',\'', 'public/css');
        $process->run();

        return explode(',', preg_replace('~[\r\n]+~', '', $process->getOutput()));
    }
}
