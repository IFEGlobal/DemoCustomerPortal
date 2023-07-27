<?php

namespace App\Http\Livewire\Documents;

use App\Models\Document;
use Carbon\Carbon;
use Livewire\Component;

class Documents extends Component
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

    public function goToContainers()
    {
        return redirect()->to('/shipments/containers');
    }

    public function goToDeliveries()
    {
        return redirect()->to('/bookings/deliveries');
    }

    public function goToShipments()
    {
        return redirect()->to('/shipments/shipments');
    }

    public function goToInvoices()
    {
        return redirect()->to('/invoices');
    }

    public function render()
    {
        $query = Document::get();

        $AllDocuments = $query->count();

        $DocumentsThisWeek = $query->whereBetween('saved_date',[now()->startOfWeek(), now()->endOfWeek()])->count();

        $DocumentsThisMonth = $query->whereBetween('saved_date',[now()->startOfMonth(), now()->endOfMonth()])->count();

        $TotalInvoices = $query->where('document_type', 'ARINV')->count();

        $TotalHouseBills = $query->where('document_type', 'HBL')->count();

        $TotalPackingLists = $query->whereIn('document_type', ['PAP','CLE','PKL'])->count();

        $TotalArrivalNotices = $query->where('document_type', 'ARN')->count();

        $OtherDocuments = $query->whereNotIn('document_type', ['ARN','PAP','CLE','HBL','ARINV','PKL'])->count();


        return view('livewire..documents.documents',[
            'AllDocuments' => $AllDocuments,
            'DocumentsThisWeek' => $DocumentsThisWeek,
            'DocumentsThisMonth' => $DocumentsThisMonth,
            'TotalInvoices' => $TotalInvoices,
            'TotalHouseBills' => $TotalHouseBills,
            'TotalPackingLists' => $TotalPackingLists,
            'TotalArrivalNotices' => $TotalArrivalNotices,
            'OtherDocuments' => $OtherDocuments
        ]);
    }
}
