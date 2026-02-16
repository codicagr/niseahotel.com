<?php

namespace App\Helpers\Admin\Entities\PseudoModels;

use Codicagr\CmsCore\Helpers\Admin\Entities\PseudoModels\BasePseudoModelConfig;

class GeneralTextConfig extends BasePseudoModelConfig
{
    public function __construct($mode = null, $recordId = null, $fromOutside = false)
    {
        $this->model = 'GeneralText';
        $this->routeName = 'general-texts';
        $this->relatedCategoryModel = 'GeneralTextCategory';
        $this->relatedCategoryRouteName = 'general-text-categories';
        $this->createPermission = 'create-general-text';

        parent::__construct($mode, $recordId, $fromOutside);
    }
}
