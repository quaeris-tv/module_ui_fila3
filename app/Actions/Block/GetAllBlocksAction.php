<?php

declare(strict_types=1);

namespace Modules\UI\Actions\Block;

use function Safe\realpath;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Illuminate\Support\Facades\File;
use Spatie\LaravelData\DataCollection;
use Modules\Xot\Datas\ComponentFileData;

use Spatie\QueueableAction\QueueableAction;
use Modules\Xot\Actions\File\GetClassNameByPathAction;

class GetAllBlocksAction
{
    use QueueableAction;

    /**
     * @return DataCollection<ComponentFileData>
     */
    public function execute(string $context = 'form'): DataCollection
    {
        Assert::string($relativePath = config('modules.paths.generator.model.path'));

        $files = File::glob(base_path('Modules').'/*/'.$relativePath.'/../Filament/Blocks/*.php');

        $blocks = Arr::map(
            $files,
            function (string $path) {
                $path = realpath($path);
                $class = app(GetClassNameByPathAction::class)->execute($path);

                $name = Str::of(class_basename($class))->snake()->toString();
                if (Str::endsWith($name, '_block')) {
                    $name = Str::before($name, '_block');
                }

                $module = Str::of($class)
                    ->between('Modules\\', '\Filament\\')
                    ->toString();

                return [
                    'name' => $name,
                    'class' => $class,
                    'module' => $module,
                    'path' => $path,
                ];
            }
        );

        return ComponentFileData::collection($blocks);
    }

}
