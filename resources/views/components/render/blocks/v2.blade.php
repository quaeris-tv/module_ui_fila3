@props(['blocks'])

@foreach ($blocks as $block)
    <x-render.block :block="$block" :model="$model" tpl="v2"/>
@endforeach
