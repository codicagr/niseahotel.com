<?php

namespace App\Helpers\Admin\Entities\PseudoModels;

use Codicagr\CmsCore\Helpers\Admin\Entities\PseudoModels\BasePseudoModelConfig;

class AmenityConfig extends BasePseudoModelConfig
{
    public function __construct($mode = null, $recordId = null, $fromOutside = false)
    {
        $this->model = 'Amenity';
        $this->routeName = 'amenities';
        $this->relatedCategoryModel = 'AmenityCategory';
        $this->relatedCategoryRouteName = 'amenity-categories';
        $this->createPermission = 'create-amenity';

        parent::__construct($mode, $recordId, $fromOutside);
    }
}
