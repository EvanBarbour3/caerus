<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * Class CleanJs
 *
 * @author EB
 * @package App\Console\Commands
 */
class CleanJs extends Command
{
    /**
     * @author EB
     * @var string
     */
    protected $signature = 'clean:js';

    /**
     * @author EB
     * @var string
     */
    protected $description = 'Clean up all computed JavaScript files that mix has created';

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

        $this->line('Removing computed JavaScript files [' . implode(',', $files) . ']');

        foreach ($files as $file) {
            $process = new Process('rm -rf ' . $file . '.*.js', 'public/js/');
            $process->run();
        }

        $this->info('Successfully removed JavaScript files');
    }

    /**
     * @author EB
     * @return array
     */
    private function getFiles()
    {
        $process = new Process('ls *.*.js | awk -F \'[.]\' \'{print $1}\' | paste -sd \',\'', 'public/js');
        $process->run();

        return explode(',', preg_replace('~[\r\n]+~', '', $process->getOutput()));
    }
}
