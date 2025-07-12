<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Payment;
use App\Models\Tagihan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Filament\Resources\PaymentResource\Pages\EditPayment;
use App\Filament\Resources\PaymentResource\Pages\ListPayments;
use App\Filament\Resources\PaymentResource\Pages\CreatePayment;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-s-credit-card';

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tagihan_id')
                    ->label('Tagihan')
                    ->relationship('tagihan', 'id', function (Builder $query) {
                        return $query->where('status', 'pending');
                    })
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->user->name . ' - ' . Carbon::parse($record->tanggal_tagihan)->format('F Y')
                    )
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $tagihan = Tagihan::with('user')->find($state);

                        if ($tagihan) {
                            $set('user_id', $tagihan->user_id);
                            $set('status', 'paid');
                            $set('bulan_tagih', Carbon::parse($tagihan->tanggal_tagihan)->format('F Y'));
                            $set('payment_type', "Manual");
                            $set('order_id', 'MANUAL-'.$tagihan->id.'-'.now()->format('Ymd'));
                            $set('paid_at', Carbon::now()->format('Y/m/d H:i:s'));
                        }
                    }),

                TextInput::make('user_id')
                    ->label("User ID")
                    ->readonly()
                    ->required(),

                TextInput::make('status')
                    ->label('Status Tagihan')
                    ->readonly(),

                TextInput::make('bulan_tagih')
                    ->label('Bulan Tagih')
                    ->readonly(),

                TextInput::make('order_id')
                    ->label('Order ID')
                    ->readonly()
                    ->maxLength(255),

                TextInput::make('payment_type')
                    ->label("Jenis Pembayaran")
                    ->readonly()
                    ->maxLength(255),

                TextInput::make('paid_at')
                    ->type('datetimes')
                    ->readonly(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('order_id')
                    ->searchable(),

                TextColumn::make('payment_type')
                    ->label('Jenis Pembayaran')
                    ->searchable(),

                TextColumn::make('transaction_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                TextColumn::make('paid_at')
                    ->label('Tanggal Bayar')
                    ->dateTime()
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
                SelectFilter::make('payment_type')
                    ->Label('Jenis Pembayaran')
                    ->options(
                        Payment::query()
                            ->select('payment_type')
                            ->distinct()
                            ->pluck('payment_type', 'payment_type')
                            ->toArray()
                            )
                    ->searchable()
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
