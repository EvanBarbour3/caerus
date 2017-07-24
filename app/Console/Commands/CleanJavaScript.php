<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CleanJavaScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up all computed JavaScript files that mix has created';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
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
        $processs = new Process('ls *.*.js | awk -F \'[.]\' \'{print $1}\' | paste -sd \',\'', 'public/js');
        $processs->run();

        return explode(',', preg_replace('~[\r\n]+~', '', $processs->getOutput()));
    }
}
