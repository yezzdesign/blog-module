<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
