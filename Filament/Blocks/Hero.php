<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\UI\Filament\Forms\Components\RadioImage;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;

class Hero
{
    public static function make(
        string $name = 'hero',
        string $context = 'form',
    ): Block {
        $options = app(GetViewBlocksOptionsByTypeAction::class)
            ->execute('hero', true);

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
<<<<<<< HEAD
                    /*
                    RadioImage::make('view')
=======
                    // *
                    RadioImage::make('_tpl')

>>>>>>> origin/v0.2.10
                        ->options($options),
                    // */
                    /*
                    Select::make('_tpl')
<<<<<<< HEAD
=======

>>>>>>> origin/v0.2.10
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
