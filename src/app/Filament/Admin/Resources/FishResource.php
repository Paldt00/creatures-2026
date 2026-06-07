<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FishResource\Pages;
use App\Models\Fish;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FishResource extends Resource
{
    protected static ?string $model = Fish::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Fish';

    protected static ?string $modelLabel = 'Fish';

    protected static ?string $pluralModelLabel = 'Fish';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Region')
                    ->schema([
                        Forms\Components\Select::make('region_id')
                            ->label('Region')
                            ->relationship('region', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                Forms\Components\Section::make('Fish Identity')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Fish Name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('scientific_name')
                            ->label('Scientific Name')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label('Fish Image')
                            ->image()
                            ->directory('fish-images')
                            ->imageEditor()
                            ->disk('public'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Fish Detail')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('characteristics')
                            ->label('Characteristics and Behavior')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('habitat')
                            ->label('Original Habitat')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('average_weight')
                            ->label('Average Weight')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('status')
                            ->label('Status')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Fish Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('scientific_name')
                    ->label('Scientific Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('region.name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name'),
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
            'index' => Pages\ListFish::route('/'),
            'create' => Pages\CreateFish::route('/create'),
            'edit' => Pages\EditFish::route('/{record}/edit'),
        ];
    }
}
