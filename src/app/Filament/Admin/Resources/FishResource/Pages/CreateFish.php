<?php

namespace App\Filament\Admin\Resources\FishResource\Pages;

use App\Filament\Admin\Resources\FishResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFish extends CreateRecord
{
    protected static string $resource = FishResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }
}
