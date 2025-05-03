<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Trend;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TrendResource\Pages;

class TrendResource extends Resource
{
    protected static ?string $model = Trend::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?string $navigationLabel = 'Tren';

    protected static ?string $navigationGroup = 'Main Menu';

    protected static ?string $breadcrumb = 'Tren';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('office_space_id')
                ->relationship('officeSpace', 'name') // Mengambil data dari model officeSpace pada field nama
                ->required()
                ->searchable()
                ->preload(),

                Select::make('is_trend')
                ->options([
                    true=> 'Popular',
                    false=> 'Not Popular',
                    ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('is_trend')
                ->formatStateUsing(fn ($state) => $state ? 'Popular' : 'Not Popular'),

                TextColumn::make('officeSpace.name')
                ->label('Kantor')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTrends::route('/'),
            'create' => Pages\CreateTrend::route('/create'),
            'edit' => Pages\EditTrend::route('/{record}/edit'),
        ];
    }
}
