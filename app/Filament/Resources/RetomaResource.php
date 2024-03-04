<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RetomaResource\Pages;
use App\Filament\Resources\RetomaResource\RelationManagers;
use App\Models\Retoma;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RetomaResource extends Resource
{
    protected static ?string $model = Retoma::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('marca')->required(),
            Forms\Components\TextInput::make('modelo')->required(),
            Forms\Components\TextInput::make('ano')->numeric()->required(),
            Forms\Components\TextInput::make('quilometragem')->numeric()->required(),
            Forms\Components\Textarea::make('descricao'),
            Forms\Components\FileUpload::make('fotos')
                ->multiple() // Permite o upload de múltiplas fotos
                ->disk('public') // Define o disco de armazenamento
                ->directory('retomas') // Define o diretório onde as fotos serão armazenadas
                ->image(), // Garante que apenas imagens possam ser carregadas
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
            'index' => Pages\ListRetomas::route('/'),
            'create' => Pages\CreateRetoma::route('/create'),
            'edit' => Pages\EditRetoma::route('/{record}/edit'),
        ];
    }
}
