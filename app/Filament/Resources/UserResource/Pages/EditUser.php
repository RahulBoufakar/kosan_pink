<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\kamar;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\DeleteAction;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function afterSave(): void
    {
        $record = $this->getRecord();
        // Check if user has a kamar assigned
        if ($record->kamar_id) {
            $kamar = kamar::find($record->kamar_id);
            if ($kamar && $kamar->status === 'tersedia') {
                $kamar->update(['status' => 'penuh']);
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
