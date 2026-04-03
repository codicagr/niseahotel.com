<?php

namespace App\Helpers\Admin\ModuleTypes;

use Codicagr\CmsCore\Helpers\Admin\ModuleTypes\BaseModuleTypeConfig;

class ModReviewsProjectConfig extends BaseModuleTypeConfig {

    public function getModuleTypeExtraFields($wireModelPrefix = 'inputFields.values.')
    {
        $this->extraFields = collect([
            [
                'slug'   => 'module',
                'title'  => 'Module',
                'fields' => [
                    'extraFields' => [
                        [
                            'slug'     => 'review-items',
                            'label'    => 'Reviews',
                            'type'     => 'repeatable',
                            'template' => [
                                [
                                    'slug'  => 'platform',
                                    'label' => 'Platform (e.g. Google, Booking)',
                                    'type'  => 'text',
                                ],
                                [
                                    'slug'  => 'platform_logo',
                                    'label' => 'Platform Logo',
                                    'type'  => 'image',
                                ],
                                [
                                    'slug'  => 'reviewer_name',
                                    'label' => 'Reviewer Name',
                                    'type'  => 'text',
                                ],
                                [
                                    'slug'  => 'date',
                                    'label' => 'Date',
                                    'type'    => 'calendar',
                                    'options' => [
                                        'no_calendar'    => false,
                                        'enable_time'    => false,
                                        'enable_seconds' => false,
                                    ],
                                ],
                                [
                                    'slug'  => 'rating',
                                    'label' => 'Rating (1-5)',
                                    'type'  => 'text',
                                ],
                                [
                                    'slug'  => 'text',
                                    'label' => 'Review Text',
                                    'type'  => 'textarea',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        return parent::getModuleTypeExtraFields($wireModelPrefix);
    }

}
