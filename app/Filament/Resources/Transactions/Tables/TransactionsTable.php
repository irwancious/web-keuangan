<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
// use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('category.image')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Transaksi')
                    ->description(fn (Transaction $record): string => $record->name)
                    ->searchable(),
                IconColumn::make('category.is_expense')
                    ->label('Tipe')
                    ->trueIcon(Heroicon::OutlinedArrowUpCircle)
                    ->falseIcon(Heroicon::OutlinedArrowDownCircle)
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->boolean(),
                TextColumn::make('date_transaction')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('note')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
