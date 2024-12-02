<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\UI\Filament\Forms\Components\RadioImage;
use Modules\Xot\Actions\View\GetViewsSiblingsAndSelfAction;

class Hero
{
    public static function make(
        string $name = 'hero',
        string $context = 'form',
    ): Block {
        $view = 'ui::components.blocks.hero.simple';
        $views = app(GetViewsSiblingsAndSelfAction::class)->execute($view);
        $options = Arr::map($views, function ($view) {
            return app(\Modules\Xot\Actions\File\AssetAction::class)
                ->execute('ui::img/screenshots/'.$view.'.png');
        });
        // ---------------

        // $files = File::glob(base_path('Modules').'/*/Resources/views/components/blocks/hero/*.blade.php');

        // $opts = Arr::mapWithKeys(
        //     $files,
        //     function ($path) {
        //         $module_low = Str::of($path)->between(DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR)
        //             ->lower()
        //             ->toString();
        //         $info = pathinfo($path);
        //         $name = Str::of($info['basename'])->before('.blade.php')->toString();

        //         $view = $module_low.'::components.blocks.hero.'.$name;
        //         $img = app(\Modules\Xot\Actions\File\AssetAction::class)
        //             ->execute($module_low.'::img/screenshots/'.$name.'.png');

        //         return [$view => $img];
        //     }
        // );

        // ---------------
        return Block::make($name)
            ->schema(
                [
                    TextInput::make('title'),
                    RichEditor::make('text'),
                    FileUpload::make('background')
                        // ->acceptedFileTypes(['application/pdf'])
                        // ->image()
                        ->directory('blocks')
                        ->preserveFilenames(),
                    // *
                    RadioImage::make('_tpl')
                        ->label('layout')
                        ->options($options),
                    // */
                    /*
                    Select::make('_tpl')
                        ->label('layout')
                        ->options($views),
                    //*/
                    Repeater::make('buttons')
                        ->schema([
                            TextInput::make('label')->required(),
                            TextInput::make('class'),
                            TextInput::make('link'),
                        ])
                        ->columns(3),
                ]
            );
    }
}
