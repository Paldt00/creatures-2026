<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WebSettingsResource\Pages;
use App\Models\Web_Settings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WebSettingsResource extends Resource
{
    protected static ?string $model = Web_Settings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Web Settings';

    protected static ?string $modelLabel = 'Web Setting';

    protected static ?string $pluralModelLabel = 'Web Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Website Content')
                    ->description('Atur gambar/logo dan deskripsi utama website.')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo / Gambar Website')
                            ->image()
                            ->directory('web-assets')
                            ->disk('public')
                            ->imageEditor(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Website')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(80),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebSettings::route('/'),
            'create' => Pages\CreateWebSettings::route('/create'),
            'edit' => Pages\EditWebSettings::route('/{record}/edit'),
        ];
    }
}
