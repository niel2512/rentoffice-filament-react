<?php

namespace App\Filament\Resources\TrendResource\Pages;

use App\Filament\Resources\TrendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrends extends ListRecords
{
    protected static string $resource = TrendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
