<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Render;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * .
 */
class Block extends Component
{
    public ?string $view = null;

    public function __construct(
        public array $block,
        public ?Model $model = null,
        public string $tpl = '',
    ) {
        $this->view = Arr::get($this->block, 'data.view', null);
    }

    public function render(): ViewFactory|View
    {
        if (! isset($this->block['type'])) {
            return view('ui::empty');
        }

        $view = $this->view;
        if (! view()->exists((string) $view)) {
            $message = 'view not exists ['.$view.']';
            $view_params = [
                'title' => 'deprecated',
                'message' => $message,
            ];

            return view('ui::alert', $view_params);
        }
        $view_params = $this->block['data'] ?? [];

        return view($view, $view_params);
    }
}
