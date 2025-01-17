<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;

class AadhaarSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aadhaarData;
    public $customerName;
    public $tokenId;
    public $service_type;

    public function __construct($aadhaarData, $customerName,$tokenId, $service_type)
    {
        $this->aadhaarData = $aadhaarData;
        $this->customerName = $customerName;
        $this->tokenId = $tokenId;
        $this->service_type = $service_type;
        
    }

    public function build()
    {
        
        // Generate the PDF content
        $pdf = PDF::loadView('pdf.aadhaar-pdf', [
            'aadhaarData' => $this->aadhaarData,
            'customerName' => $this->customerName,
            'tokenId' => $this->tokenId,
            'service_type' => $this->service_type,
        ]);
        return $this->view('emails.aadhaar-success')
                    ->with([
                        'aadhaarData' => $this->aadhaarData,
                        'customerName' => $this->customerName,
                        'tokenId' => $this->tokenId,
                        'service_type' => $this->service_type,
                    ])
                    ->attachData($pdf->output(), 'aadhaar_details.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
