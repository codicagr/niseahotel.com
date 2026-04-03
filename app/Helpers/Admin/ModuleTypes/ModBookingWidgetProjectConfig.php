<?php

namespace App\Helpers\Admin\ModuleTypes;

use Codicagr\CmsCore\Helpers\Admin\ModuleTypes\BaseModuleTypeConfig;

class ModBookingWidgetProjectConfig extends BaseModuleTypeConfig {

    public function getModuleTypeExtraFields($wireModelPrefix = 'inputFields.values.')
    {
        $this->extraFields = collect([
            [
                'slug' => 'module',
                'title' => 'Module',
                'fields' => [
                    'extraFields' => [
                        [
                            'slug' => 'arrival-title',
                            'label' => 'Arrival Title',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'arrival-error',
                            'label' => 'Arrival Error',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'arrival-separator',
                            'type' => 'separator',
                        ],
                        [
                            'slug' => 'nights-title',
                            'label' => 'Nights Title',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'min-nights',
                            'label' => 'Min Nights',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'max-nights',
                            'label' => 'Max Nights',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'nights-separator',
                            'type' => 'separator',
                        ],
                        [
                            'slug' => 'adults-title',
                            'label' => 'Adults Title',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'adults-note',
                            'label' => 'Adults Note',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'min-adults',
                            'label' => 'Min Adults',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'max-adults',
                            'label' => 'Max Adults',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'adults-separator',
                            'type' => 'separator',
                        ],
                        [
                            'slug' => 'children-title',
                            'label' => 'Children Title',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'children-note',
                            'label' => 'Children Note',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'min-children',
                            'label' => 'Min Children',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'max-children',
                            'label' => 'Max Children',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'children-separator',
                            'type' => 'separator',
                        ],
                        [
                            'slug' => 'infants-title',
                            'label' => 'Infants Title',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'infants-note',
                            'label' => 'Infants Note',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'min-infants',
                            'label' => 'Min Infants',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'max-infants',
                            'label' => 'Max Infants',
                            'type' => 'integer',
                        ],
                        [
                            'slug' => 'infants-separator',
                            'type' => 'separator',
                        ],
                        [
                            'slug' => 'link',
                            'label' => 'Link',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'link-label',
                            'label' => 'Link Label',
                            'type' => 'text',
                            'translatable' => 'true'
                        ],
                        [
                            'slug' => 'target',
                            'type' => 'select',
                            'label' => 'Target',
                            'defaultValue' => '_self',
                            'choices' => [
                                [
                                    'label' => 'Parent Window',
                                    'value' => '_self',
                                ],
                                [
                                    'label' => 'New Tab',
                                    'value' => '_blank',
                                ],
                            ],
                        ],
                    ]
                ]
            ]
        ]);
        return parent::getModuleTypeExtraFields($wireModelPrefix);
    }

}
