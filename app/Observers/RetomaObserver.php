<?php

namespace App\Observers;

use App\Models\Retoma;
use App\Events\RetomaCreated;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\OpenAIController;

class RetomaObserver
{
    /**
     * Handle the Retoma "created" event.
     */
    public function created(Retoma $retoma): void
    {
        RetomaCreated::dispatch($retoma);
        Log::info('Retoma criada: ' . $retoma->id);
        // Outras ações que você deseja registrar nos logs
    }
  
    
    /**
     * Handle the Retoma "updated" event.
     */
    public function updated(Retoma $retoma): void
    {
        //
    }

    /**
     * Handle the Retoma "deleted" event.
     */
    public function deleted(Retoma $retoma): void
    {
        //
    }

    /**
     * Handle the Retoma "restored" event.
     */
    public function restored(Retoma $retoma): void
    {
        //
    }

    /**
     * Handle the Retoma "force deleted" event.
     */
    public function forceDeleted(Retoma $retoma): void
    {
        //
    }
}
