<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DanoResource\Pages;
use App\Filament\Resources\DanoResource\RelationManagers;
use App\Models\Dano;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DanoResource extends Resource
{
    protected static ?string $model = Dano::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('marca'),
                FileUpload::make('fotos')
                ->multiple() // Permite o upload de múltiplas fotos
                ->disk('public') // Define o disco de armazenamento
                ->directory('danos') // Define o diretório onde as fotos serão armazenadas
                ->image(), // Garante que apenas imagens possam ser carregadas,
                Textarea::make('resposta_ai'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDanos::route('/'),
            'create' => Pages\CreateDano::route('/create'),
            'edit' => Pages\EditDano::route('/{record}/edit'),
        ];
    }
}
