<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * 客服接待命令，将等待的用户接入客服对接
 * Class Customer
 * @package App\Console\Commands
 */
class Customer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $arg = $this->argument('action');
        switch ($arg) {
            case 'start':
                $this->start();
                break;
        }
    }

    /**
     * 启动 客服接待系统，
     *
     */
    public function start()
    {

    }
}
