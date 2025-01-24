<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Storage;

class TokenPurchaseEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tokens;
    public $order;

    public function __construct(User $user, $tokens,$order)
    {
        $this->user = $user;
        $this->tokens = $tokens;
        $this->order = $order;

    }
    public function build()
    {
        // dd($this->user, $this->tokens); 

        // Generate the PDF content
        $pdf = PDF::loadView('emails.tokens', ['tokens' => $this->tokens, 'user' => $this->user, $this->order]);

        // Build the email
        return $this->subject('Token Purchase Details')
                    ->view('emails.token_purchase')
                    ->attachData($pdf->output(), 'tokens.pdf');
    }
}
