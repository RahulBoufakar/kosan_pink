<?php

namespace App\Observers;

use App\Models\Kamar;

class KamarObserver
{
    /**
     * Handle the Kamar "created" event.
     */
    public function created(Kamar $kamar): void
    {
        //
    }

    /**
     * Handle the Kamar "updated" event.
     */
    public function updated(Kamar $kamar): void
    {
        //
    }

    /**
     * Handle the Kamar "deleted" event.
     */
    // public function deleted(Kamar $kamar): void
    // {
    //     $user = $kamar->user;
    //     dd($user);
    //     if ($user) {
    //         $user->kamar_id = null;
    //         $user->save();

    //         $user->delete(); // Soft delete, if User model uses SoftDeletes
    //     }
    // }

    public function deleting(Kamar $kamar): void
    {
        $user = $kamar->user;
        if ($user) {
            $user->kamar_id = null;
            $user->save();
            $user->delete();
        }
    }

    /**
     * Handle the Kamar "restored" event.
     */
    public function restored(Kamar $kamar): void
    {
        //
    }

    /**
     * Handle the Kamar "force deleted" event.
     */
    public function forceDeleted(Kamar $kamar): void
    {
        //
    }
}
