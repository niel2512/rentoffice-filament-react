<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\BookingTransaction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxlength(255),

                TextInput::make('booking_trx_id')
                ->required()
                ->maxlength(255),

                TextInput::make('phone_number')
                ->required()
                ->maxlength(13),

                TextInput::make('total_amount')
                ->required()
                ->numeric()
                ->prefix('Rp. '),

                TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Hari'),

                DatePicker::make('started_at')
                ->required(),

                DatePicker::make('ended_at')
                ->required(),

                Select::make('is_paid')
                ->options([
                    true => 'Sudah Bayar',
                    false => 'Belum Bayar',
                ])
                ->required(),

                Select::make('office_space_id')
                ->relationship('officeSpace', 'name') // Mengambil data dari model officeSpace pada field nama
                ->required()
                ->searchable()
                ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_trx_id')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),

                TextColumn::make('officeSpace.name'),

                TextColumn::make('started_at')
                ->date(),
                TextColumn::make('ended_at')
                ->date(),

                IconColumn::make('is_paid')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Sudah Bayar?'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
