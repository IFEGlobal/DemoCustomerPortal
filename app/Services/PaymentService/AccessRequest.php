<?php

namespace App\Services\PaymentService;

use App\DataResources\OutstandingBalanceResource;
use Carbon\Carbon;
use DateTime;

class AccessRequest
{
    public ?string $invoice_number;

    public ?string $payment_type;

    public ?float $amount;

    public ?int $id;

    public function __construct($invoice_number,$payment_type,$amount,$id)
    {
        $this->invoice_number = $invoice_number;

        $this->payment_type = $payment_type;

        $this->amount = $amount;

        $this->id = $id;
    }

    public function ProcessRequest()
    {
        if($this->payment_type == "Entire")
        {
            return $this->ProcessCompletePaymentRequest();
        }

        return $this->ProcessPartPaymentRequest();
    }

    public function ProcessCompletePaymentRequest()
    {
        $paymentData = [
            'externalReference' => $this->invoice_number,
            'linkExpiry' => strtotime(now()->addMinutes(12)),
            'amount' => $this->amount,
            'currency' => "GBP",
            'retryFailedAttempts' => 1,
            'companyId' => "findOut",
            'brandId' => "findOut",
            "fpReference" => "HO-25CTNvC9",
            "description" => "tAf7Sd",
            "autoInitiate" => true,
            "redirectUrl" => "https://mayan.live/invoices/payments",
        ];

        dd($paymentData);
    }

    public function ValidateCurrentBalance()
    {

    }
}
