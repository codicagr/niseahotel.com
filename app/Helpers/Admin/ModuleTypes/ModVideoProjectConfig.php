<?php

namespace App\Helpers\Admin\ModuleTypes;

use Codicagr\CmsCore\Helpers\Admin\ModuleTypes\BaseModuleTypeConfig;

class ModVideoProjectConfig extends BaseModuleTypeConfig {

    public function getModuleTypeExtraFields($wireModelPrefix = 'inputFields.values.')
    {
        $this->extraFields = collect([
            [
                'slug' => 'module',
                'title' => 'Module',
                'fields' => [
                    'extraFields' => [
                        [
                            'slug' => 'desktopVideo',
                            'label' => 'Desktop Video',
                            'type' => 'file',
                        ],
                        [
                            'slug' => 'mobileVideo',
                            'label' => 'Mobile Video',
                            'type' => 'file',
                        ],
                        [
                            'slug' => 'scroll-separator',
                            'type' => 'separator',
                        ],
                        [
                            'slug' => 'scroll-icon',
                            'type' => 'radio',
                            'label' => 'Show scroll icon',
                            'defaultValue' => '0',
                            'choiceStyles' => [
                                '0' => 'red'
                            ],
                            'choices' => [
                                '0' => 'No',
                                '1' => 'Yes',
                            ],
                        ],
                    ]
                ]
            ]
        ]);
        return parent::getModuleTypeExtraFields($wireModelPrefix);
    }

}
