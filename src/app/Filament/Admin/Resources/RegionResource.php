<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RegionResource\Pages;
use App\Filament\Admin\Resources\RegionResource\RelationManagers\FishesRelationManager;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Regions';

    protected static ?string $modelLabel = 'Region';

    protected static ?string $pluralModelLabel = 'Regions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Region Detail')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Region')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\Hidden::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar / Peta Region')
                            ->image()
                            ->directory('region-images')
                            ->imageEditor()
                            ->disk('public'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Air Tawar Region')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('fishes_count')
                    ->counts('fishes')
                    ->label('Total Creatures')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FishesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegions::route('/'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}
