<?php

namespace App\Filament\Resources\KamarResource\Pages;

use App\Filament\Resources\KamarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKamar extends EditRecord
{
    protected static string $resource = KamarResource::class;

    protected function beforeSave(): void
    {
        // Your logic here
        if ($this->data['status'] === 'tersedia') {
            $this->record->user()->update(['kamar_id' => null]);
        }
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
