<?php

namespace App\Observers;

use App\Models\Retoma2;
use App\Events\Retoma2Created;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\OpenAI2Controller;

class Retoma2Observer
{
    /**
     * Handle the Retoma "created" event.
     */
    public function created(Retoma2 $retoma): void
    {
        Retoma2Created::dispatch($retoma);
        Log::info('Retoma criada: ' . $retoma->id);
        // Outras ações que você deseja registrar nos logs
    }
  
    
    /**
     * Handle the Retoma "updated" event.
     */
    public function updated(Retoma2 $retoma): void
    {
        //
    }

    /**
     * Handle the Retoma "deleted" event.
     */
    public function deleted(Retoma2 $retoma): void
    {
        //
    }

    /**
     * Handle the Retoma "restored" event.
     */
    public function restored(Retoma2 $retoma): void
    {
        //
    }

    /**
     * Handle the Retoma "force deleted" event.
     */
    public function forceDeleted(Retoma2 $retoma): void
    {
        //
    }
}
