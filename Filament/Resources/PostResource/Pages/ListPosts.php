<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\PostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
