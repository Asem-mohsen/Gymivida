<?php

namespace App\Filament\Resources;

use App\Enums\AppLocale;
use App\Enums\DocumentationType;
use App\Filament\Resources\DocumentationResource\Pages;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Unique;

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
                    ->options(DocumentationType::class)
                    ->required()
                    ->live()
                    ->helperText('Select the type of documentation. Each type may have one file per language.'),
                Forms\Components\Select::make('locale')
                    ->label('Language')
                    ->options(AppLocale::class)
                    ->required()
                    ->default(AppLocale::En->value)
                    ->live()
                    ->unique(
                        ignoreRecord: true,
                        modifyRuleUsing: function (Unique $rule, Get $get): Unique {
                            return $rule->where('type', $get('type'));
                        },
                    )
                    ->helperText('Upload an English and Arabic PDF for each type. If Arabic is missing, visitors on /ar receive the English file.'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('PDF File')
                    ->directory(function (Get $get): string {
                        $type = DocumentationType::tryFrom((string) $get('type'));
                        $locale = AppLocale::normalize($get('locale'))->value;
                        $base = $type?->storageDirectory() ?? 'demos';

                        return $base . '/' . $locale;
                    })
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(102400)
                    ->disk('public')
                    ->required()
                    ->helperText('Upload a PDF file (max 100MB). Note: Ensure PHP upload_max_filesize and post_max_size are at least 100M.'),
                Forms\Components\TextInput::make('file_name')
                    ->label('File Name (Optional)')
                    ->maxLength(255)
                    ->helperText('Custom name for the file. If left empty, a language-aware default filename will be used.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (DocumentationType|string $state): string => match ($state instanceof DocumentationType ? $state : DocumentationType::tryFrom((string) $state)) {
                        DocumentationType::Documentation => 'success',
                        DocumentationType::Registration => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (DocumentationType|string $state): string => $state instanceof DocumentationType
                        ? ($state->getLabel() ?? $state->value)
                        : (DocumentationType::tryFrom((string) $state)?->getLabel() ?? (string) $state))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('locale')
                    ->label('Language')
                    ->badge()
                    ->formatStateUsing(fn (AppLocale|string $state): string => $state instanceof AppLocale
                        ? ($state->getLabel() ?? $state->value)
                        : (AppLocale::tryFrom((string) $state)?->getLabel() ?? (string) $state))
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
                    ->options(DocumentationType::class),
                Tables\Filters\SelectFilter::make('locale')
                    ->options(AppLocale::class),
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
        return [];
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
