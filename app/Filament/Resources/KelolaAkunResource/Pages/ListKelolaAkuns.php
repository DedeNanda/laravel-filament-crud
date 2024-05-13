<?php

namespace App\Filament\Resources\KelolaAkunResource\Pages;

use App\Filament\Resources\KelolaAkunResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelolaAkuns extends ListRecords
{
    protected static string $resource = KelolaAkunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
