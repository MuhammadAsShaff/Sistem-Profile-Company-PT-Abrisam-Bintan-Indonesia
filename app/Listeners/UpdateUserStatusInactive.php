<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;

class UpdateUserStatusInactive
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        // Update status admin menjadi 'tidak aktif'
        DB::table('admins')->where('email_admin', $event->user->email_admin)->update(['status' => 'Offline']);
    }
}
