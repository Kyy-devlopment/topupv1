<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use App\Models\Banner;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\BannerResource\Pages;
use Filament\Tables\Columns\ToggleColumn;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Banner Management';
    protected static ?string $pluralModelLabel = 'Banners';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->imagePreviewHeight('150') // Preview agar lebih cepat
                    ->maxSize(2048)             // Maks 2MB
                    ->directory('banners')      // Folder penyimpanan
                    ->disk('public')            // Gunakan disk publik
                    ->preserveFilenames()       // Gunakan nama asli file
                    ->required(),

                TextInput::make('link')
                    ->url()
                    ->nullable(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(80),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('link')
                    ->limit(30),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Dibuat'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}