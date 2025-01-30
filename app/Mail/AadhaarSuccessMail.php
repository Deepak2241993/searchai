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
    public $createdData;
    public $order_id;
    public $client_data;

    public function __construct($aadhaarData, $customerName,$tokenId, $service_type,$createdData,$order_id,$client_data)
    {
        $this->aadhaarData = $aadhaarData;
        $this->customerName = $customerName;
        $this->tokenId = $tokenId;
        $this->service_type = $service_type;
        $this->createdData = $createdData;
        $this->order_id = $order_id;
        $this->client_data = $client_data;
        
    }

    public function build()
    {
        
        // Generate the PDF content
        $pdf = PDF::loadView('pdf.aadhaar-pdf', [
            'aadhaarData' => $this->aadhaarData,
            'customerName' => $this->customerName,
            'tokenId' => $this->tokenId,
            'service_type' => $this->service_type,
            'createdData' => $this->createdData,
            'order_id' => $this->order_id,
            'client_data' => $this->client_data,
        ]);
        return $this->subject('Your Background Verification Report is Ready')
        ->view('emails.aadhaar-success')
                    ->with([
                        'aadhaarData' => $this->aadhaarData,
                        'customerName' => $this->customerName,
                        'tokenId' => $this->tokenId,
                        'service_type' => $this->service_type,
                        'createdData' => $this->createdData,
                        'order_id' => $this->order_id,
                        'client_data' => $this->client_data,
                    ])
                    ->attachData($pdf->output(), 'aadhaar_details.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
