<?php

namespace LaravelAngular\Generators\Console\Commands;

use File;
use Illuminate\Console\Command;

class AngularService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ng:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service in angular/services';

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
        $name = $this->argument('name');
        $studly_name = studly_case($name);

        $js = file_get_contents(__DIR__.'/Stubs/AngularService/service.js.stub');

        $js = str_replace('{{StudlyName}}', $studly_name, $js);

        $folder = base_path(config('ng.source')).'/'.config('ng.services');

        //create service (.js)
        File::put($folder.'/'.$name.'.js', $js);

        $this->info('Service created successfully.');
    }
}
