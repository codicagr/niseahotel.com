<?php

namespace App\Helpers\Admin\Entities\PseudoModels;

use Codicagr\CmsCore\Helpers\Admin\Entities\PseudoModels\BasePseudoModelCategoryConfig;

class GeneralTextCategoryConfig extends BasePseudoModelCategoryConfig
{
    public function __construct($mode = null, $recordId = null, $fromOutside = false)
    {
        $this->model = 'GeneralTextCategory';
        $this->routeName = 'general-text-categories';

        parent::__construct($mode, $recordId, $fromOutside);
    }

}
