<?php

namespace App\Console\Commands;
use App\Models\Renting;
use App\Models\Vehicle;
use Illuminate\Console\Command;

class CheckPUDDate extends Command
{
    protected $signature = 'custom:check-pud-date';

    protected $description = 'Check and update vehicle status based on PUD date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = date('Y-m-d');
        $rentings = Renting::get();
    
        foreach ($rentings as $renting) {
            $PUD = $renting->PUD;
            $PUD = date('Y-m-d', strtotime($PUD));
            if ($PUD === $now) {
                $vehicle = Vehicle::findOrFail($renting->vehicle_id);
                $vehicle->Status = 'Rented';
                $vehicle->Current_Owner=auth()->user()->name;
                $vehicle->save();
            }
        }
    
        $this->info('Vehicle status updated for matching PUD dates.');
    }
    
}
