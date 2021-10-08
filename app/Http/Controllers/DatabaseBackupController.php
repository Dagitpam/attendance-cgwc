<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;



class DatabaseBackupController extends Controller
{
    
    /**
     * Create database backup
    */
    public function create()
    {
        try {
            /* only database backup*/
           Artisan::call('backup:run --only-db');
            /* all backup */
            /* Artisan::call('backup:run'); */
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
            session()->flash('success', 'Successfully created backup!');
            return redirect()->back();
          } catch (\Exception $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->back();
        }
        
    }
    
}
