<?php

namespace App\Helpers\Admin\Entities\PseudoModels;

use Codicagr\CmsCore\Helpers\Admin\Entities\PseudoModels\BasePseudoModelCategoryConfig;

class AmenityCategoryConfig extends BasePseudoModelCategoryConfig
{
    public function __construct($mode = null, $recordId = null, $fromOutside = false)
    {
        $this->model = 'AmenityCategory';
        $this->routeName = 'amenity-categories';

        parent::__construct($mode, $recordId, $fromOutside);
    }

}
