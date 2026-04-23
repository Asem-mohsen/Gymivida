<?php

namespace App\Filament\Resources;

use App\Enums\FaqKind;
use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $modelLabel = 'FAQ';

    protected static ?string $pluralModelLabel = 'FAQs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Order')
                            ->integer()
                            ->minValue(0)
                            ->required()
                            ->default(fn () => (Faq::query()->max('sort_order') ?? 0) + 1)
                            ->helperText('Lower numbers appear first on the website.'),
                        Forms\Components\Select::make('kind')
                            ->label('Type')
                            ->options([
                                FaqKind::Static->value => 'Static (use the answers below)',
                                FaqKind::FreeTrial->value => 'Free trial (answer is built from each product’s trial days)',
                            ])
                            ->required()
                            ->default(FaqKind::Static->value)
                            ->native(false)
                            ->live(),
                        Forms\Components\Select::make('documentation_type')
                            ->label('Attach download link')
                            ->options([
                                'documentation' => 'Demo documentation (Content → Documentation: Demo)',
                                'registration' => 'Registration demo (Content → Documentation: Registration)',
                            ])
                            ->placeholder('No download link')
                            ->visible(fn (Get $get) => $get('kind') === FaqKind::Static->value)
                            ->helperText('Optional. Renders a download link under the answer using the PDF from Documentation Manager (same as /admin/documentations/1 for the demo).')
                            ->native(false),
                    ])
                    ->columns(2),
                Forms\Components\Tabs::make('Content')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\Textarea::make('question_en')
                                    ->label('Question (English)')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('answer_en')
                                    ->label('Answer (English)')
                                    ->rows(8)
                                    ->columnSpanFull()
                                    ->visible(fn (Get $get) => $get('kind') === FaqKind::Static->value)
                                    ->required(fn (Get $get) => $get('kind') === FaqKind::Static->value)
                                    ->helperText('For “Static” only. For “Free trial”, answers are generated from products.'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Arabic')
                            ->schema([
                                Forms\Components\Textarea::make('question_ar')
                                    ->label('Question (العربية)')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('answer_ar')
                                    ->label('Answer (العربية)')
                                    ->rows(8)
                                    ->columnSpanFull()
                                    ->visible(fn (Get $get) => $get('kind') === FaqKind::Static->value)
                                    ->required(fn (Get $get) => $get('kind') === FaqKind::Static->value)
                                    ->helperText('للأسئلة الثابتة فقط. سؤال التجربة المجانية يُملأ تلقائياً من المنتجات.'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kind')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $k = $state instanceof FaqKind ? $state : FaqKind::tryFrom($state);

                        return match ($k) {
                            FaqKind::FreeTrial => 'Free trial',
                            FaqKind::Static => 'Static',
                            default => (string) $state,
                        };
                    })
                    ->color(function ($state) {
                        $k = $state instanceof FaqKind ? $state : FaqKind::tryFrom($state);

                        return $k === FaqKind::FreeTrial ? 'success' : 'gray';
                    }),
                Tables\Columns\TextColumn::make('question_en')
                    ->label('Question (EN)')
                    ->searchable()
                    ->limit(60)
                    ->wrap(),
                Tables\Columns\TextColumn::make('question_ar')
                    ->label('Question (AR)')
                    ->searchable()
                    ->limit(60)
                    ->toggleable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('documentation_type')
                    ->label('Download')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'documentation' => 'Demo PDF',
                        'registration' => 'Registration PDF',
                        default => '—',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('kind')
                    ->options([
                        FaqKind::Static->value => 'Static',
                        FaqKind::FreeTrial->value => 'Free trial',
                    ])
                    ->native(false),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
