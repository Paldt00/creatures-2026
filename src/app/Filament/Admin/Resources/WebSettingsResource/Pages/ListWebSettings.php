<?php

namespace App\Filament\Admin\Resources\WebSettingsResource\Pages;

use App\Filament\Admin\Resources\WebSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebSettings extends ListRecords
{
    protected static string $resource = WebSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
