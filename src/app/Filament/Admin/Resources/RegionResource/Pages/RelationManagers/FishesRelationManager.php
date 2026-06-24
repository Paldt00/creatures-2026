<?php

namespace App\Filament\Admin\Resources\RegionResource\RelationManagers;

use App\Models\Fish;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FishesRelationManager extends RelationManager
{
    protected static string $relationship = 'fishes';

    protected static ?string $title = 'Creatures';

    protected static ?string $modelLabel = 'Creature';

    protected static ?string $pluralModelLabel = 'Creatures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Creature Identity')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Creature')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\Hidden::make('slug')
                            ->dehydrated()
                            ->required()
                            ->unique(
                                table: 'fishes',
                                column: 'slug',
                                ignoreRecord: true
                            ),

                        Forms\Components\TextInput::make('scientific_name')
                            ->label('Nama Ilmiah')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Creature')
                            ->image()
                            ->directory('fish-images')
                            ->disk('public')
                            ->imageEditor(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Creature Detail')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('characteristics')
                            ->label('Karakteristik dan Perilaku')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('habitat')
                            ->label('Habitat Asli')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('average_weight')
                            ->label('Berat Rata-rata')
                            ->maxLength(255),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Extinct' => 'Extinct',
                                'Endangered' => 'Endangered',
                                'Least Concern' => 'Least Concern',
                                'Data Deficient' => 'Data Deficient',
                                'Invasive' => 'Invasive',
                            ])
                            ->searchable()
                            ->native(false),

                        Forms\Components\Select::make('biogeography')
                            ->label('Biogeografi')
                            ->options([
                                'Native' => 'Native',
                                'Endemic' => 'Endemic',
                                'Introduction' => 'Introduction',
                            ])
                            ->searchable()
                            ->native(false),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Creatures di Region Ini')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('scientific_name')
                    ->label('Nama Ilmiah')
                    ->searchable(),

                Tables\Columns\TextColumn::make('habitat')
                    ->label('Habitat'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge(),

                Tables\Columns\TextColumn::make('biogeography')
                    ->label('Biogeografi')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Creature')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = Auth::id();

                        if (blank($data['slug'] ?? null) && filled($data['name'] ?? null)) {
                            $data['slug'] = $this->makeUniqueFishSlug($data['name']);
                        }

                        if (filled($data['slug'] ?? null)) {
                            $data['slug'] = $this->makeUniqueFishSlug($data['slug']);
                        }

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        if (blank($data['slug'] ?? null) && filled($data['name'] ?? null)) {
                            $data['slug'] = $this->makeUniqueFishSlug($data['name']);
                        }

                        return $data;
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    private function makeUniqueFishSlug(string $value): string
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $counter = 2;

        while (Fish::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
