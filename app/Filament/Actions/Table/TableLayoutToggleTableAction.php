<?php

declare(strict_types=1);

namespace Modules\UI\app\Filament\Actions\Table;

use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Session;
use Modules\UI\Enums\TableLayout;

class TableLayoutToggleTableAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $current = $this->getCurrentLayout();

        $this
            ->label('Toggle Layout')
            ->tooltip($current->getLabel())
            ->color($current->getColor())
            ->icon($current->getIcon())
            ->action(fn ($livewire) => $this->toggleLayout($livewire));
    }

    protected function toggleLayout($livewire): void
    {
        $currentLayout = $this->getCurrentLayout();
        $newLayout = $currentLayout->toggle();
        
        Session::put('table_layout', $newLayout->value);

        if ($livewire) {
            $livewire->layoutView = $newLayout;
            $livewire->dispatch('$refresh');
            $livewire->dispatch('refreshTable');
            $livewire->resetTable();
        }
    }

    protected function getCurrentLayout(): ?TableLayout
    {
        return TableLayout::tryFrom(Session::get('table_layout', TableLayout::GRID->value));
    }
}
