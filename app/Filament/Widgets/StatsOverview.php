<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
    protected function getStats(): array
    {
        $startDate = ! is_null($this->pageFilters['startDate'] ?? null) ?
            Carbon::parse($this->pageFilters['startDate']) :
            null;

        $endDate = ! is_null($this->pageFilters['endDate'] ?? null) ?
            Carbon::parse($this->pageFilters['endDate']) :
            now();

        $pemasukan = Transaction::incomes()
            ->whereBetween('date_transaction', [$startDate, $endDate])
            ->sum('amount');
        $pengeluaran = Transaction::expenses()
            ->whereBetween('date_transaction', [$startDate, $endDate])
            ->sum('amount');

        return [
            Stat::make('Total Pemasukan', 'Rp.'.' '.$pemasukan),
            Stat::make('Total Pengeluaran','Rp.'.' ' .$pengeluaran),
            Stat::make('Selisih', 'Rp.'.' '.$pemasukan - $pengeluaran),
        ];
    }
}
