<?php

namespace App\Mail;

use App\Models\Contract;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceivedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $payment;

    public function __construct(Contract $contract, Payment $payment)
    {
        $this->contract = $contract;
        $this->payment = $payment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💰 Nuevo Pago Recibido - Contrato #' . $this->contract->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-received',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}