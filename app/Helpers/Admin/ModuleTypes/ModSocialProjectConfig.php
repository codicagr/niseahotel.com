<?php

namespace App\Helpers\Admin\ModuleTypes;

use Codicagr\CmsCore\Helpers\Admin\ModuleTypes\BaseModuleTypeConfig;

class ModSocialProjectConfig extends BaseModuleTypeConfig {

    public function getModuleTypeExtraFields($wireModelPrefix = 'inputFields.values.')
    {

        $this->extraFields = collect([
            [
                'slug' => 'module',
                'title' => 'Module',
                'fields' => [
                    'extraFields' => [
                        [
                            'slug' => 'social-items',
                            'label' => 'Social Items',
                            'type' => 'repeatable',
                            'template' => [
                                [
                                    'slug' => 'title',
                                    'label' => 'Title',
                                    'type' => 'text',
                                ],
                                [
                                    'slug' => 'link',
                                    'label' => 'Link',
                                    'type' => 'text',
                                ],
                                [
                                    'slug' => 'icon',
                                    'label' => 'Icon',
                                    'type' => 'image',
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
