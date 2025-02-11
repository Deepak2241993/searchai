<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CCRVReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $caseData;
    public $totalCase;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($caseData, $totalCase, $token)
    {
        $this->caseData = $caseData;
        $this->totalCase = $totalCase;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Criminal Background Screening Report'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ccrvreport',
            with: [
                'caseData' => $this->caseData,
                'totalCase' => $this->totalCase,
                'token' => $this->token,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
