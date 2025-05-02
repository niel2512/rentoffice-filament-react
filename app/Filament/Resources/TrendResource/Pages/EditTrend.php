<?php

namespace App\Filament\Resources\TrendResource\Pages;

use App\Filament\Resources\TrendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrend extends EditRecord
{
    protected static string $resource = TrendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
