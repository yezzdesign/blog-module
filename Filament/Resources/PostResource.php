<?php

namespace Modules\Blog\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Model;
use Modules\Acc\Entities\User;
use Modules\Blog\Entities\Post;
use Modules\Blog\Filament\Resources\PostResource\RelationManagers\LinksRelationManager;
use Modules\Library\Entities\Book;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    use SoftDeletes;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon    = 'heroicon-o-collection';

    protected static ?string $slug  =   'post';

    protected static ?int $navigationSort   =   1;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(6)
            ->schema([
                Tabs::make('Heading')
                    ->columnSpan(6)
                    ->tabs([
                        Tabs\Tab::make(__('blog::index.form.tab1.label'))
                            ->columns(6)
                            ->schema([
                                Section::make(__('blog::index.form.title.section.title'))
                                    ->description(__('blog::index.form.title.section.description'))
                                    ->compact()
                                    ->aside()
                                    ->schema([
                                        Select::make('author_id')
                                            ->label( __('blog::index.form.author_id.label') )
                                            ->searchable()
                                            ->required()
                                            ->options(User::all()->pluck('name', 'id'))
                                        ,
                                        TextInput::make('title')
                                            ->label( __('blog::index.form.title.name') )
                                            ->required(),
                                    ]),

                                Section::make(__('blog::index.form.is_launched.section.title'))
                                    ->description(__('blog::index.form.is_launched.section.description'))
                                    ->compact()
                                    ->aside()
                                    ->schema([
                                        Toggle::make('is_launched')
                                            ->label( __('blog::index.form.is_launched.section.title') )
                                            ->hint( __(__('blog::index.form.is_launched.name')) )
                                            ->hintIcon('heroicon-o-question-mark-circle'),

                                        Forms\Components\DatePicker::make('launch_date')
                                            ->label(__('blog::index.form.launch_date.label')),
                                    ]),



                                Forms\Components\Fieldset::make(__('blog::index.form.image.section.title'))
                                    ->schema([
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('Cover')
                                            ->image()
                                            ->collection('blog')
                                            ->conversion('full')
                                            ->columnSpan(6),
                                    ]),

                            ]),
                        Tabs\Tab::make(__('blog::index.form.tab2.label'))
                            ->schema([
                                Forms\Components\Fieldset::make(__('blog::index.form.short_content.section.title'))
                                    ->schema([
                                        TextInput::make('content_short')
                                            ->columnSpanFull()
                                            ->label( __('blog::index.form.short_content.name') ),
                                    ]),


                                TinyEditor::make('content')
                                    ->label( __('blog::index.form.content.name') )
                                    ->showMenuBar()
                                    ->fileAttachmentsDirectory( fn( Post $record ):string => 'blog\\'. $record->id .'\\attachments\\' )
                                ,
                            ]),
                        Tabs\Tab::make(__('blog::index.form.tab3.label'))
                            ->schema([
                                Select::make('book_id')
                                    ->label('Book')
                                    ->options(Book::all()->pluck('title', 'id'))
                                    ->searchable()
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label(__('blog::index.table.id'))
                    ->visibleFrom('sm')
                    ->sortable(),

                Tables\Columns\SpatieMediaLibraryImageColumn::make(__('blog::index.table.cover_image_path'))
                    ->collection('blog')
                    ->conversion('thumb')
                    ->width(60)
                    ->height(60),

                IconColumn::make('date for launch')
                    ->tooltip( (fn(Post $record):string => ($record->launch_date)? \Carbon\Carbon::parse($record->launch_date,config('app.timezone'))->translatedFormat('d F, Y') : 'n/a') )
                    ->label( __('blog::index.table.launch_date') )
                    ->sortable()
                    ->boolean()
                    ->default(fn(Post $record) => ($record->launch_date < now() && $record->launch_date != null))
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                IconColumn::make('is_launched')
                    //->tooltip( (fn(Post $record):string => ($record->launch_date)? \Carbon\Carbon::parse($record->launch_date,config('app.timezone'))->translatedFormat('d F, Y') : 'n/a') )
                    ->label( __('blog::index.table.launch_status') )
                    ->sortable()
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('title')
                    ->label( __('blog::index.table.title'))
                    ->visibleFrom('sm')
                    ->tooltip( fn(Post $record):string => $record->title??'' )
                    ->limit(15)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('content_short')
                    ->label( __('blog::index.table.content_short') )
                    ->tooltip( fn(Post $record):string => $record->content_short??'' )
                    ->searchable()
                    ->sortable()
                    ->visibleFrom('xl')
                    ->limit(15),

                Tables\Columns\TextColumn::make('author.name')
                    ->label( __('blog::index.table.author') )
                    ->description( fn(Post $record):string => $record->author->email??'' )
                    ->tooltip( fn (Post $record):string => $record->author->email??'')
                    ->searchable(['name', 'email'])
                    ->visibleFrom('sm')
                    ->sortable(),

                Tables\Columns\TextColumn::make('categories')
                    ->label( __('blog::index.table.categories') )
                    ->searchable()
                    ->visibleFrom('xl')
                    ->sortable(),
            ])
            ->filters([
                //Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\Blog\Filament\Resources\PostResource\Pages\ListPosts::route('/'),
            'create' => \Modules\Blog\Filament\Resources\PostResource\Pages\CreatePost::route('/create'),
            'edit' => \Modules\Blog\Filament\Resources\PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static function getNavigationGroup(): string
    {
        return __('blog::index.filament.title.post_settings');
    }

    protected static function getNavigationLabel(): string
    {
        return __('blog::index.filament.label.post_settings');
    }
}
