@props([
    'position',
    'modules'   => null,
    'tag'       => 'section',
    'container'     => false,
    'containerSize' => '',
])
@php $modules = $modules ?? view()->shared('modules', []); @endphp

@if(ModuleFacade::moduleExists($modules, $position))
    @php
        $id    = $attributes->has('id') ? $attributes->get('id') : $position;
        $attrs = ' ' . $attributes->except(['container', 'container-size'])->merge(['id' => $id])->toHtml();
    @endphp
    {!! "<{$tag}{$attrs}>" !!}
        @if($container)
            <div class="ccPage">
                <div class="ccPageInner {{ $containerSize }}">
                    {!! ModuleFacade::getModules($modules, $position) !!}
                </div>
            </div>
        @else
            {!! ModuleFacade::getModules($modules, $position) !!}
        @endif
    {!! "</{$tag}>" !!}
@endif
