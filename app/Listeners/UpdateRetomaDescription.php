<?php

namespace App\Listeners;

use App\Events\RetomaCreated;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\OpenAIController;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateRetomaDescription
{
    /**
     * Create the event listener.
     */
    protected $openAIController;

    public function __construct(OpenAIController $openAIController)
    {
        $this->openAIController = $openAIController;
    }

    public function handle(RetomaCreated $event)
    {
        $retoma = $event->retoma;
        $this->openAIController->analyzeImagesAndUpdateDescription($retoma->id);
    }
     
}
