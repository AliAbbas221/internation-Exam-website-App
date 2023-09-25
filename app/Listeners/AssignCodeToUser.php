<?php

namespace App\Listeners;

use App\Models\Code;
use App\Events\UserCreated;
use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignCodeToUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Code::create([
            'value' => Str::random(10),
            'collage_id'=>$event->collage_id,
            'user_id' =>$event->user->id
        ]);
     }
}
