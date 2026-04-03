@extends('themes.default.layout.main')

@php
    $item = data_get($data,'record', []);
    $id = data_get($item,'id');
    $modules = data_get($data,'modules',[]);
    $menu = data_get($data,'menu',[]);
    $image = BaseFacade::getImage(data_get($item,'image'));
    $alt = data_get($item,'image_alt','');
    if ($alt == '') {
        $alt = data_get($item,'title');
    }

    $fields = BaseFacade::getFields('Item',$id) ?? [];
    $leadTitle = data_get($item,'title', '');
    $text = data_get($item,'fulltext', '');
@endphp

@section('mainContent')
    <div class="itemViewContainer general item{{ $id }} paddingTop80">

        <x-blocks.page-lead
            :title="$leadTitle"
            class="noMargin"
        />

        @if ($text)
            <div class="mainWrapper ccPage paddingTop80">
                <div class="ccPageInner x-small">
                    <div class="floatBox">
                        {!! $text !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@pushonce('header_styles_stack','generalItem')
    @vite([
        'resources/sass/themes/default/components/content/general/general-item.scss'
    ])
@endpushonce
