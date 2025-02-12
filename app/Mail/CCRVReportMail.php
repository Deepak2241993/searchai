<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;

class CCRVReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cases;
    public $caseCount;
    public $token;
    public $victimdata;

    /**
     * Create a new message instance.
     */
    public function __construct($cases, $caseCount, $token, $victimdata)
    {
        $this->cases = $cases;
        $this->caseCount = $caseCount;
        $this->token = $token;
        $this->victimdata = $victimdata;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Generate the PDF
        $pdf = Pdf::loadView('pdf.ccrv_report', [
            'cases' => $this->cases,
            'caseCount' => $this->caseCount,
            'token' => $this->token,
            'victimdata' => $this->victimdata,
        ]);
        // Attach the PDF and build the email content
        return $this->subject('Criminal Background Screening Report')
                    ->view('emails.ccrvreport')
                    ->with([
                        'cases' => $this->cases,
                        'caseCount' => $this->caseCount,
                        'token' => $this->token,
                        'victimdata' => $this->victimdata,
                    ])
                    ->attachData($pdf->output(), 'ccrv_report.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
