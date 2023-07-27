<?php

namespace App\Http\Livewire\Invoicing;

use App\Models\JobInvoicing;
use Livewire\Component;

class ViewInvoiceBreakdown extends Component
{
    public $breakdown;

    public function mount($invoice_number)
    {
        $this->breakdown = JobInvoicing::where('sell_invoice_number', $invoice_number)->whereHas('shipment')->get();
    }

    public function render()
    {
        return view('livewire.invoicing.view-invoice-breakdown');
    }


    public function PayLine($line, $amount)
    {

    }
}
