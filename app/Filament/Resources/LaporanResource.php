<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Laporan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LaporanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanResource\RelationManagers;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')->required()->label('NIK'),
                TextInput::make('nama_pelapor')->label('Nama Pelapor'),
                Select::make('jurusan')
                    ->options([
                        'IPA' => 'IPA',
                        'IPS' => 'IPS',
                        'AKUTANSI' => 'AKUTANSI',
                        'TKJ' => 'TKJ',
                        'ANIMASI' => 'ANIMASI',
                    ])->label('Jurusan'),
                TextInput::make('no_hp')->numeric()->label('Nomor Handphone'),
                DatePicker::make('tanggal_kejadian')->native(false)->displayFormat('d-m-Y')->label('Tanggal Kejadian'),
                TextInput::make('tempat_kejadian')->label('Tempat Kejadian'),
                TextInput::make('nama_korban')->label('Nama Korban'),
                TextInput::make('nama_pelaku')->label('Nama Pelaku'),
                Textarea::make('deskripsi_kejadian')->label('Deskripsi Kejadian'),
                //selanjutnya tambahkan saksi-saksi ini lupa
                FileUpload::make('bukti_photo')->directory('laporan')->label('Bukti Photo'), //->multiple()->openable(), mutliplace dan openable itu bisa memasukan file sebanyak mungkin


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')->label('NIK')->sortable()->searchable(),
                TextColumn::make('nama_pelapor')->label('Nama Pelapor')->searchable(),
                TextColumn::make('jurusan')->label('Jurusan')->sortable()->searchable(),
                TextColumn::make('no_hp')->label('Nomor Handphone'),
                TextColumn::make('tanggal_kejadian')->label('Tanggal Kejadian')->formatStateUsing(function ($record) {
                    // Format tanggal
                    return date('d-m-Y', strtotime($record->tanggal_kejadian));
                }),
                ImageColumn::make('bukti_photo')->label('Bukti Photo'), //untuk lihat gambar di dalam storage/app/public


                // php artisan storage:link silahkan buat dulu dari link berikut
                // terus ubah di .env menjadi http://localhost:8000

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }
}
