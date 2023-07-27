<?php

namespace App\Http\Livewire\Documents;

use App\Models\Document;
use App\Services\DataService\RequestDocument;
use Illuminate\Http\Response;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ViewDocument extends Component
{
    use WireToast;

    public $document;

    public $extention;

    public function mount($id)
    {
        $this->document = Document::find($id);

        $this->extention = substr ($this->document->file_name, -3) ?? null;
    }

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

    public function requestFile($id)
    {
        $documentRequest = new RequestDocument();
        $document = $documentRequest->CreatePacket($this->document);

        if(is_array($document)) {
            if(isset($document['File']))
            {
                $filename = $document['FileName'] ?? 'FileDownload';
                $download = base64_decode($document['File']);
                $contents = $download;

                $headers = ['Content-Type' => 'application/pdf'];

                return response()->streamDownload(function () use ($contents) {
                    echo $contents;
                }, $filename);
            }

            if(isset($document['Response']))
            {
                return toast()->warning($document['Response'],$document['Type'])->push();
            }

            return toast()->warning('Something went wrong. We are currently looking into the issue','Error')->push();
        }

        return 'Something went wrong. We are currently looking into the issue';

    }

    public function viewInvoice()
    {
        return redirect()->to('/invoices/view/'.$this->document->linked_reference);
    }

    public function render()
    {
        return view('livewire.documents.view-document');
    }
}
