<?php

namespace App\Filament\Admin\Resources\WebSettingsResource\Pages;

use App\Filament\Admin\Resources\WebSettingsResource;
use App\Models\Region;
use App\Models\Web_Settings;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListWebSettings extends ListRecords
{
    protected static string $resource = WebSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('createRegion')
                ->label('Add Region')
                ->color('primary')
                ->form([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Region')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar / Peta Region')
                        ->image()
                        ->directory('region-images')
                        ->disk('public')
                        ->imageEditor(),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi Air Tawar Region')
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->action(function (array $data): void {
                    Region::create([
                        'name' => $data['name'],
                        'slug' => $this->makeUniqueRegionSlug($data['name']),
                        'image' => $data['image'] ?? null,
                        'description' => $data['description'] ?? null,
                    ]);

                    Notification::make()
                        ->title('Region berhasil ditambahkan')
                        ->success()
                        ->send();
                }),

            Actions\CreateAction::make()
                ->label('Web Setting')
                ->visible(fn (): bool => ! Web_Settings::query()->exists()),
        ];
    }

    private function makeUniqueRegionSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 2;

        while (Region::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
