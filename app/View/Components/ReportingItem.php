<?php

namespace App\View\Components;

use App\Models\ReportingDataItem;
use App\Models\ReportingItem as ModelsReportingItem;
use Illuminate\View\Component;

class ReportingItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.reporting-item', [
            'reportingItems' => ModelsReportingItem::get(),
            'reportingDataItems' => ReportingDataItem::get()
        ]);
    }
}
