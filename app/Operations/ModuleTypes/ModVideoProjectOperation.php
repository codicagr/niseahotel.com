<?php

namespace App\Operations\ModuleTypes;

use Illuminate\Http\Request;
use Codicagr\CmsCore\Operations\ModuleTypes\BaseModuleTypeOperation;

class ModVideoProjectOperation extends BaseModuleTypeOperation
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
        $desktopVideo = data_get($this->moduleParameters, 'desktopVideo', '');
        if ($desktopVideo != '') {
            $desktopVideo = \Storage::disk('uploads')->url($desktopVideo);
        }
        $mobileVideo = data_get($this->moduleParameters, 'mobileVideo', '');
        if ($mobileVideo != '') {
            $mobileVideo = \Storage::disk('uploads')->url($mobileVideo);
        }
        $scrollIcon = data_get($this->moduleParameters, 'scroll-icon', 0);

        return array_merge([
            'desktopVideo' => $desktopVideo,
            'mobileVideo' => $mobileVideo,
            'scrollIcon' => $scrollIcon,
        ], $this->dataToReturn);
    }
}
