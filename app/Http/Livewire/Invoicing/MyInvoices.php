<?php

namespace App\Http\Livewire\Invoicing;

use App\Models\Document;
use App\Models\JobInvoicing;
use Livewire\Component;

class MyInvoices extends Component
{
    public function goToLiveDashboard()
    {
        return redirect()->to('/dashboard');
    }

    public function goToCalendar()
    {
        return redirect()->to('/calendar');
    }

    public function goToPriorities()
    {
        return redirect()->to('/space/priorities');
    }

    public function goToDocuments()
    {
        return redirect()->to('/documents');
    }

    public function render()
    {
        $AllInvoices = Document::where('document_type', '=', 'ARINV')
            ->whereHas('chargeLines', function ($limit){
                $limit->whereNull('sell_fully_paid_date')
                    ->where('sell_os_amount','>', 0.00);
            })->count();

        $OverDueInvoices = Document::where('document_type', '=', 'ARINV')
            ->whereHas('chargeLines', function ($limit){
                $limit->whereNull('sell_fully_paid_date')
                ->where('sell_posted_due_date', '<', now())
                ->where('sell_os_amount','>', 0.00);
            })->count();

        $InvoiceDueThisWeek = Document::where('document_type', '=', 'ARINV')
            ->whereHas('chargeLines', function ($limit){
                $limit->whereNull('sell_fully_paid_date')
                    ->whereBetween('sell_posted_due_date', [now()->startOfWeek(), now()->endOfWeek()])
                    ->where('sell_os_amount','>', 0.00);
            })->count();

        $InvoiceDueThisMonth = Document::where('document_type', '=', 'ARINV')
            ->whereHas('chargeLines', function ($limit){
                $limit->whereNull('sell_fully_paid_date')
                ->whereBetween('sell_posted_due_date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->where('sell_os_amount','>', 0.00);
            })->count();

        return view('livewire.invoicing.my-invoices',[
            'AllInvoices' => $AllInvoices,
            'OverDueInvoices' => $OverDueInvoices,
            'InvoicesDueThisWeek' => $InvoiceDueThisWeek,
            'InvoicesDueThisMonth' => $InvoiceDueThisMonth,
        ]);
    }
}
