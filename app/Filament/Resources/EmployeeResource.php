<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
// use Intervention\Image\Image;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use App\Filament\Resources\EmployeeResource\Pages;
use Intervention\Image\Facades\Image;




class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationGroup = 'Karyawan';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                ->required()
                ->maxLength(20),
            Select::make('division_id')
                ->required()
                ->relationship('division', 'name')
                ->searchable(),
            TextInput::make('position')
                ->required()
                ->maxLength(255),
            FileUpload::make('image')
                ->image()
                ->nullable()
                ->disk('public')
                ->directory('employees')
            // ->afterSaving(function ($file) {
            //     $img = Image::make($file->getRealPath());
            //     $img->resize(800, 800, function ($constraint) {
            //         $constraint->aspectRatio();
            //         $constraint->upsize();
            //     });
            //     $img->save($file->getRealPath());
            // }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('phone')
                ->sortable(),
            Tables\Columns\TextColumn::make('division.name')
                ->label('Division')
                ->sortable(),
            Tables\Columns\TextColumn::make('position')
                ->sortable(),
            Tables\Columns\ImageColumn::make('image')
                ->disk('public'),
            // TextColumn::make('Aksi')
            //     ->label('Aksi'),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
