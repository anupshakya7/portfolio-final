<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StorageSymlink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:symlink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link Storage in Server';

    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storagePath = storage_path('app/public');
        $publicPath = public_path('storage');

        if(!file_exists($publicPath)){
            if(symlink($storagePath,$publicPath)){
                echo "Symlink Created Successfully!!!";
            }else{
                echo "Failed to create symlink";
            }
        }else{
            echo "Already Exists";
        }
    }
}
