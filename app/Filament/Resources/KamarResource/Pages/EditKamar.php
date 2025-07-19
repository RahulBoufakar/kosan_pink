<?php

namespace App\Filament\Resources\KamarResource\Pages;

use Log\Log;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\KamarResource;

class EditKamar extends EditRecord
{
    protected static string $resource = KamarResource::class;

    protected $oldStatus = null;

    protected function beforeSave(): void
    {
        // Capture the old status before saving
        $this->oldStatus = $this->record->getOriginal('status');
    }

    protected function afterSave(): void
    {
        $record = $this->record;
        
        // If kamar changed from penuh → tersedia
        if ($this->oldStatus === 'penuh' && $record->status === 'tersedia') {
            // Get users assigned to this kamar
            $user = $record->user()->first();
            if ($user) {
                $user->kamar_id = null;
                $user->delete(); // soft delete
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}