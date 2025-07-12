<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Laporan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\LaporanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanResource\RelationManagers;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                FileUpload::make('media')
                    ->required()
                    ->label('Media')
                    ->disk('public')
                    ->directory('laporan_media/images')
                    ->visibility('public')
                    ->columnSpan('full'),
                DateTimePicker::make('tanggal_laporan')
                    ->required()
                    ->readonly(),
                Select::make('status_laporan')
                    ->label('Status Laporan')
                    ->options([
                        'proses' => 'Proses',
                        'selesai' => 'Selesai'
                    ])
                    ->default(fn($record)=>$record?->status_laporan),
                TextInput::make('user_id')
                    ->required()
                    ->numeric()
                    ->readonly(),
                Textarea::make('deskripsi')
                    ->required()
                    ->maxLength(255)
                    ->readonly()
                    ->columnSpan('full')
                    ->readonly(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('media')
                    ->disk('public'),
                TextColumn::make('tanggal_laporan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('deskripsi')
                    ->searchable(),
                TextColumn::make('status_laporan'),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
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
                SelectFilter::make('status_laporan')
                    ->label('Status Laporan')
                    ->options(
                        Laporan::query()
                        ->select('status_laporan')
                        ->distinct()
                        ->pluck('status_laporan', 'status_laporan')
                        ->toArray()
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
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }
}
