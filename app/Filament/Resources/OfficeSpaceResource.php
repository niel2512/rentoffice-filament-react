<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\OfficeSpace;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\OfficeSpaceResource\Pages;

class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    
    protected static ?string $navigationLabel = 'Kantor';

    protected static ?string $navigationGroup = 'Main Menu';

    protected static ?string $breadcrumb = 'Kantor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxlength(255),     

                TextInput::make('address')
                ->required()
                ->maxlength(64),     
                
                FileUpload::make('thumbnail')
                ->required()
                ->image(),

                Textarea::make('about')
                ->required()
                ->rows(10)
                ->cols(20),

                //diambil dari model office space di public function photos
                Repeater::make('photos')
                ->relationship('photos') 
                ->schema([
                    FileUpload::make('photo')
                    ->required()
                    ->image(),
                ]),

                //diambil dari model office space di public function benefits
                Repeater::make('benefits')
                ->relationship('benefits')
                ->schema([
                    TextInput::make('name')
                    ->label('Benefit')
                    ->required(),
                ]),

                Select::make('city_id')
                ->relationship('city', 'name')
                ->preload()
                ->required()
                ->searchable(),

                TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('Rp'),

                TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Days'),

                Select::make('is_open')
                ->options([
                    true=> 'Open',
                    false=> 'Closed',
                ])
                ->required(),

                Select::make('is_full_booked')
                ->options([
                    true=> 'Not Available',
                    false=> 'Available',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),

                ImageColumn::make('thumbnail')->label('Gambar'),

                TextColumn::make('city.name'),

                IconColumn::make('is_full_booked')
                ->boolean()
                ->trueColor('danger')
                ->falseColor('success')
                ->label('Available')
                ->trueIcon('heroicon-o-x-circle')
                ->falseIcon('heroicon-o-check-circle'),
            ])
            ->filters([
                SelectFilter::make('city_id')
                ->label('City')
                ->relationship('city', 'name'),
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}
