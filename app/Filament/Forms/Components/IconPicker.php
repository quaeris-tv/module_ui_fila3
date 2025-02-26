<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Forms\Components;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Arr;
use Modules\UI\Actions\Icon\GetAllIconsAction;
use Webmozart\Assert\Assert;

class IconPicker extends TextInput
{
    protected function setUp(): void
    {
        parent::setUp();

        $icons = app(GetAllIconsAction::class)->execute();

        $packs = array_keys($icons);
        // $packs = $icons->toCollection()->keys()->toArray();
        $packs = array_combine($packs, $packs);
        // dddx($icons->toCollection()->get('heroicons')->toArray());

        $this->suffixAction(
            \Filament\Forms\Components\Actions\Action::make('icon')
                ->icon(fn (?string $state) => $state)
            // ->modalContent(fn ($record) => view('ui::filament.forms.components.icon-picker', ['record' => $record]))
                ->form([
                    Select::make('pack')
                        ->options($packs)
                        ->reactive()
                        ->live(),
                    RadioIcon::make('newstate')
                        ->options(function (Get $get) use ($icons): array {
                            $pack = $get('pack');
                            if (! is_string($pack)) {
                                return [];
                            }
                            $key = $pack.'.icons';
                            Assert::isArray($opts = Arr::get($icons, $key, []), '['.__LINE__.']['.class_basename($this).']');
                            $opts = array_combine($opts, $opts);

                            return $opts;
                        })
                        ->inline()
                        ->inlineLabel(false),
                ])
                ->action(function (array $data, Set $set) {
                    $set('icon', $data['newstate']);
                })
        );
    }
}
