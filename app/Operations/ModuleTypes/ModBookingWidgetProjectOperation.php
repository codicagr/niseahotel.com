<?php

namespace App\Operations\ModuleTypes;

use Illuminate\Http\Request;
use Codicagr\CmsCore\Operations\ModuleTypes\BaseModuleTypeOperation;

class ModBookingWidgetProjectOperation extends BaseModuleTypeOperation
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
        $arrivalTitle = data_get($this->moduleParameters, 'arrival-title', '');
        $arrivalError = data_get($this->moduleParameters, 'arrival-error', '');
        $nightsTitle = data_get($this->moduleParameters, 'nights-title', '');
        $minNights = data_get($this->moduleParameters, 'min-nights', '');
        $maxNights = data_get($this->moduleParameters, 'max-nights', '');
        $adultsTitle = data_get($this->moduleParameters, 'adults-title', '');
        $adultsNote = data_get($this->moduleParameters, 'adults-note', '');
        $minAdults = data_get($this->moduleParameters, 'min-adults', '');
        $maxAdults = data_get($this->moduleParameters, 'max-adults', '');
        $childrenTitle = data_get($this->moduleParameters, 'children-title', '');
        $childrenNote = data_get($this->moduleParameters, 'children-note', '');
        $minChildren = data_get($this->moduleParameters, 'min-children', '');
        $maxChildren = data_get($this->moduleParameters, 'max-children', '');
        $infantsTitle = data_get($this->moduleParameters, 'infants-title', '');
        $infantsNote = data_get($this->moduleParameters, 'infants-note', '');
        $minInfants = data_get($this->moduleParameters, 'min-infants', '');
        $maxInfants = data_get($this->moduleParameters, 'max-infants', '');
        $link = data_get($this->moduleParameters, 'link', '');
        $linkLabel = data_get($this->moduleParameters, 'link-label', '');
        $target = data_get($this->moduleParameters, 'target', '');

        return array_merge([
            'arrival_title' => $arrivalTitle,
            'arrival_error' => $arrivalError,
            'nights_title' => $nightsTitle,
            'min_nights' => $minNights,
            'max_nights' => $maxNights,
            'adults_title' => $adultsTitle,
            'adults_note' => $adultsNote,
            'min_adults' => $minAdults,
            'max_adults' => $maxAdults,
            'children_title' => $childrenTitle,
            'children_note' => $childrenNote,
            'min_children' => $minChildren,
            'max_children' => $maxChildren,
            'infants_title' => $infantsTitle,
            'infants_note' => $infantsNote,
            'min_infants' => $minInfants,
            'max_infants' => $maxInfants,
            'link' => $link,
            'link_label' => $linkLabel,
            'target' => $target,
        ], $this->dataToReturn);
    }
}
