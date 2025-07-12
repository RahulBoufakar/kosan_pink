<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;
        
        // Check if tagihan exists and update its status
        if ($record->tagihan_id && $record->tagihan) {
            $record->tagihan->update(['status' => 'paid']);
        }
    }
}
