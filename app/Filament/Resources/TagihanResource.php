<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tagihan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\TagihanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TagihanResource\RelationManagers;
use App\Filament\Resources\TagihanResource\Pages\EditTagihan;
use App\Filament\Resources\TagihanResource\Pages\ListTagihans;
use App\Filament\Resources\TagihanResource\Pages\CreateTagihan;

class TagihanResource extends Resource
{
    protected static ?string $model = Tagihan::class;

    protected static ?string $navigationIcon = 'heroicon-s-inbox-arrow-down';

    public static function canCreate(): bool
    {
        return false;
    }
    
    public static function canEdit(Model $record): bool
    {
        if ($record->status === 'paid') {
            return false;
        }
        return true;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }





    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->required()
                    ->numeric()
                    ->readonly(),
                DatePicker::make('tanggal_tagihan')
                    ->required()
                    ->readonly(),
                TextInput::make('jumlah_tagihan')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->readonly()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label("Nama Penghuni")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tanggal_tagihan')
                    ->date()
                    ->sortable(),
                TextColumn::make('jumlah_tagihan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Tagihan')
                    ->options(
                        Tagihan::query()
                        ->select('status')
                        ->distinct()
                        ->pluck('status', 'status')
                        ->toArray(),
                    )
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTagihans::route('/'),
            'create' => Pages\CreateTagihan::route('/create'),
            'edit' => Pages\EditTagihan::route('/{record}/edit'),
        ];
    }
}
