<?php

namespace App\Filament\Admin\Resources\WebSettingsResource\Pages;

use App\Filament\Admin\Resources\WebSettingsResource;
use App\Models\Web_Settings;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateWebSettings extends CreateRecord
{
    protected static string $resource = WebSettingsResource::class;

    public function mount(): void
    {
        if (Web_Settings::query()->exists()) {
            Notification::make()
                ->title('Web setting sudah ada')
                ->body('Kamu hanya bisa mengedit web setting yang sudah dibuat.')
                ->warning()
                ->send();

            $this->redirect(WebSettingsResource::getUrl('index'));

            return;
        }

        parent::mount();
    }
}
