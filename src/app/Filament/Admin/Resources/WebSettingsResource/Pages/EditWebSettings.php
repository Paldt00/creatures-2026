<?php

namespace App\Filament\Admin\Resources\WebSettingsResource\Pages;

use App\Filament\Admin\Resources\WebSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebSettings extends EditRecord
{
    protected static string $resource = WebSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
