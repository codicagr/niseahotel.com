<?php

namespace App\Operations\ModuleTypes;

use Illuminate\Http\Request;
use Codicagr\CmsCore\Operations\ModuleTypes\BaseModuleTypeOperation;

class ModSocialProjectOperation extends BaseModuleTypeOperation
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
     * Perform default module operation .
     *
     * @return array
     */
    protected function performDefaultModuleOperation()
    {
        $socialItems = data_get($this->moduleParameters, 'social-items', []);

        return array_merge([
            'social-items' => $socialItems,
        ], $this->dataToReturn);
    }
}
