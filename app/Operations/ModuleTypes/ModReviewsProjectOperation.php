<?php

namespace App\Operations\ModuleTypes;

use Illuminate\Http\Request;
use Codicagr\CmsCore\Operations\ModuleTypes\BaseModuleTypeOperation;

class ModReviewsProjectOperation extends BaseModuleTypeOperation
{
    /**
     * Execute the operation.
     *
     * @return array
     */
    public function handle(Request $request)
    {
        parent::handle($request);
        return $this->performDefaultModuleOperation();
    }

    /**
     * Perform default module operation.
     *
     * @return array
     */
    protected function performDefaultModuleOperation()
    {
        $reviewItems = data_get($this->moduleParameters, 'review-items', []);

        return array_merge([
            'review-items' => $reviewItems,
        ], $this->dataToReturn);
    }
}
