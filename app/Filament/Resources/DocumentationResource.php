<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentationResource\Pages;
use App\Filament\Resources\DocumentationResource\RelationManagers;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Documentation Manager';
    
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Documentation Type')
                    ->options([
                        'documentation' => 'Demo Documentation',
                        'registration' => 'Registration Demo',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Select the type of documentation. Each type can only have one file.'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('PDF File')
                    ->directory(fn ($get) => $get('type') === 'documentation' ? 'demos' : 'registration-demos')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(102400)
                    ->disk('public')
                    ->required()
                    ->helperText('Upload a PDF file (max 100MB). Note: Ensure PHP upload_max_filesize and post_max_size are at least 100M.'),
                Forms\Components\TextInput::make('file_name')
                    ->label('File Name (Optional)')
                    ->maxLength(255)
                    ->helperText('Custom name for the file. If left empty, original filename will be used.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'documentation' => 'success',
                        'registration' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'documentation' => 'Demo Documentation',
                        'registration' => 'Registration Demo',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_name')
                    ->label('File Name')
                    ->default('Not set')
                    ->searchable()
                    ->formatStateUsing(fn ($record, $state) => $state ?: 'Not set'),
                Tables\Columns\IconColumn::make('file_path')
                    ->label('File Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => $state ? basename($state) : 'Not uploaded')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'documentation' => 'Demo Documentation',
                        'registration' => 'Registration Demo',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDocumentations::route('/'),
            'create' => Pages\CreateDocumentation::route('/create'),
            'view' => Pages\ViewDocumentation::route('/{record}'),
            'edit' => Pages\EditDocumentation::route('/{record}/edit'),
        ];
    }
}
