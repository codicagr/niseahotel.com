@props([
    'section',
    'loop' => null
])

@php
    $addresses = collect(data_get($section, 'addresses', []))->map(function($addr) {
        return data_get($addr, 'link')
            ? '<a href="'.data_get($addr, 'link').'" target="'.data_get($addr, 'target','_blank').'">'.data_get($addr, 'title').'</a>'
            : data_get($addr, 'title');
    })->implode(', ');

    $phones = collect(data_get($section, 'phone-numbers', []))->map(function($p) {
        $clean = str_replace([' ','.','-'], '', data_get($p, 'phone-number'));
        return '<a href="tel:'.$clean.'" target="_blank">'.data_get($p, 'phone-number').'</a>';
    })->implode(', ');

    $emails = collect(data_get($section, 'emails', []))->map(function($e) {
        $mail = data_get($e, 'email');
        return '<a href="mailto:'.$mail.'" target="_blank">'.$mail.'</a>';
    })->implode(', ');
@endphp

<div {{ $attributes->merge(['class' => 'itemSection floatBox contact-map ' . data_get($section,'background') . ' ' . data_get($section,'margin') . ' ' . data_get($section,'padding') . ' ' . data_get($section,'padding-spacing')]) }}>
    <div class="contactMapModule flex flexWrap">
        <div class="contactContainer floatBox flex justifyCenter itemsCenter">
            <div class="contactContent flex flexColumn gap30">

                <div class="sectionContentContainer flex flexWrap gap20">
                    @if(data_get($section,'title'))
                        <div class="sectionContentTitle" data-stagger-child>
                            {!! data_get($section,'title') !!}
                        </div>
                    @endif
                    @if(data_get($section,'text'))
                        <div class="sectionContentText" data-stagger-child>
                            {!! data_get($section,'text') !!}
                        </div>
                    @endif
                </div>

                <div class="contactInfoContainer">
                    @if($addresses)
                        <div class="contactInfoListItem contactInfoAddress flex" data-stagger-child>
                            <div class="contactInfoValue">
                                {!! $addresses !!}
                            </div>
                        </div>
                    @endif
                    @if($phones)
                        <div class="contactInfoListItem contactInfoPhone flex" data-stagger-child>
                            <div class="contactInfoValue">
                                {!! $phones !!}
                            </div>
                        </div>
                    @endif
                    @if($emails)
                        <div class="contactInfoListItem contactInfoEmail flex" data-stagger-child>
                            <div class="contactInfoValue">
                                {!! $emails !!}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="socialList flex">
                    @foreach (data_get($section,'social-items',[]) as $social)
                        <x-layout.social.item
                            :socialItem="$social"
                        />
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mapContainer floatBox">
            <div class="mapContent">
                <div class="iframeWrapper floatBox">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15908.9682125753!2d26.965335409060586!3d37.70232156109266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bc3d4703c79635%3A0x594e5a00801c8dae!2sNisea%20Hotel%20Samos!5e0!3m2!1sen!2sgr!4v1773679965530!5m2!1sen!2sgr" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@pushonce('header_styles_stack','mapsModule')
    @vite(['resources/sass/themes/default/components/elements/contact-map/contact-map.scss'])
@endpushonce
