<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

use Filament\Widgets\Widget as BaseWidget;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class GroupWidget extends XotBaseWidget
{
    public array $widgets = [];
    protected static ?string $pollingInterval = null;
    
}
