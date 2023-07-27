<?php

namespace App\Http\Livewire\Invoicing;

use App\Models\Document;
use App\Models\JobInvoicing;
use App\Models\Shipment;
use App\Services\PaymentService\AccessRequest;
use Livewire\Component;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

class ViewInvoice extends Component
{
    public $invoices;

    public $shipment_id;

    public $document;

    public $extention;

    public $invoice_number;

    public $shipment;

    public $outstandingAmount;

    public function goTo(string $url): void
    {
        redirect()->to($url);
    }

    public function mount($linked_reference)
    {
        $this->invoices = JobInvoicing::select('sell_local_amount', 'sell_invoice_number', 'sell_outstanding_amount', 'sell_posted_due_date','sell_fully_paid_date', 'sell_posted_transaction_type','shipment_id')
            ->where('sell_invoice_number',$linked_reference)
            ->whereHas('shipment')
            ->get();

        $this->shipment_id = $this->invoices->first()->shipment_id;

        $this->document = Document::where('linked_reference', $linked_reference)->first();

        $this->extention = substr ($this->document->file_name, -3) ?? null;

        $this->invoice_number = $linked_reference ?? null;

        $this->outstandingAmount = $this->calculateOutstandingAmount($this->invoices);
    }

    public function calculateOutstandingAmount($collection): float|string
    {
        if($collection !== 0)
        {
            $calculation = $collection->where('sell_fully_paid_date', '=', null)->map(function($query){
                return $query->sell_local_amount ?? 0.00;
            })->sum();

            return number_format((float)$calculation, 2, '.', '') ?? 0.00;
        }

        return 0.00;
    }

    public function render()
    {
        return view('livewire.invoicing.view-invoice');
    }

    public function PayInvoice($amount)
    {
        $paymentService = new AccessRequest($this->invoice_number,'Entire',$amount,$this->shipment_id);
        $paymentService->ProcessRequest();
    }
}
