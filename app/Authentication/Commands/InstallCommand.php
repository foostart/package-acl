<?php namespace Foostart\Acl\Authentication\Commands;

use Illuminate\Console\Command;
use Foostart\Acl\Database\DatabaseSeeder;

class InstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'authentication:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel Authentication With package-acl.';

    protected $call_wrapper;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($call_wrapper = null, $db_seeder = null)
    {
        $this->call_wrapper = $call_wrapper ? $call_wrapper : new CallWrapper($this);
        $this->db_seeder = $db_seeder ? $db_seeder : new DatabaseSeeder();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->call_wrapper->call('vendor:publish', ['force']);

        $this->call_wrapper->call('migrate');
        $this->db_seeder->run();

        $this->info('## Laravel Authentication With package-acl Installed successfully ##');
    }
    
    public function handle()
    {
        $this->fire();
    }
}
