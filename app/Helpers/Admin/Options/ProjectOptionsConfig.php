<?php

namespace App\Helpers\Admin\Options;

use Codicagr\CmsCore\Helpers\Admin\Options\GlobalOptionsConfig;

class ProjectOptionsConfig extends GlobalOptionsConfig
{
    public function getOptions($wireModelPrefix = 'options.')
    {
        $this->options = collect([
            [
                'slug' => 'user',
                'title' => 'User',
                'fields' => [
                    'options' => [
                        [
                            'slug' => 'booking_engine_url',
                            'type' => 'text',
                            'placeholder' => 'Booking Engine URL',
                            'label' => 'Booking Engine URL',
                            'translatable' => true
                        ],
                    ]
                ]
            ],
        ]);
        return parent::getOptions($wireModelPrefix);
    }

    public function getGlobalOptionValues()
    {
        return \GlobalOptionsFacade::getOptions('Project');
    }
}
