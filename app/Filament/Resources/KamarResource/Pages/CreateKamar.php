<?php

namespace App\Filament\Resources\KamarResource\Pages;

use App\Models\kamar;
use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\KamarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKamar extends CreateRecord
{
    protected static string $resource = KamarResource::class;

    public function beforeCreate(): void
    {
                
        $kamar = $this->data['nomor_kamar'];

        if (kamar::where('nomor_kamar', $kamar)->exists()) {
            Notification::make()
                ->title('Room already exists')
                ->danger()
                ->send();

            // Prevent creation
            $this->halt();
        }
    }
}
