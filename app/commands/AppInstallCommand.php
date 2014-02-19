<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class AppInstallCommand
 */
class AppInstallCommand extends Command {

    private $startTime;
    private $endTime;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run application installation.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->startTime = microtime(true);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info('Installing');

        // Install Sentry
        $this->info(' + Executing (cartalyst/sentry) Migrations');
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));

        // App migraions
        $this->info(' + Executing App Migrations');
        $this->call('migrate');

        $this->endTime = microtime(true);
        $executionTime = round( ($this->endTime - $this->startTime)/60, 3 );
        $this->info('Completed in '.$executionTime.' seconds');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}
