<?php

namespace App\Console\Commands;

use App\Models\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Webklex\IMAP\Facades\Client;

class SincronizarMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mails:sincronizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizar correos desde IMAP y guardarlos en la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->all()->get();

        $this->info("Total correos encontrados: " . $messages->count());

        foreach ($messages as $message) {
            $message_id = $message->getMessageId();

            // Evitar duplicados
            if (Mail::where('message_id', $message_id)->exists()) {
                continue;
            }

            $from = $message->getFrom()[0];
            $flags = $message->getFlags()->toArray();

            $to = $this->extraerCorreosValidos($message->getTo()->get());
            $cc = $this->extraerCorreosValidos($message->getCc()->get());
            $bcc = $this->extraerCorreosValidos($message->getBcc()->get());

            $mail = Mail::create([
                'message_id' => $message_id,
                'uid' => $message->getUid(),
                'folder' => $folder->name,
                'subject' => $message->getSubject(),
                'from_name' => $from->personal ?? null,
                'from_email' => $from->mail,
                'to' => $to,
                'cc' => $cc,
                'bcc' => $bcc,
                'date' => optional($message->getDate())->get(),
                'is_seen' => in_array('\\Seen', $flags),
                'flags' => $flags,
                'body_text' => $message->getTextBody(),
                'body_html' => $message->getHTMLBody(),
                'has_attachments' => $message->hasAttachments(),
                'attachments_count' => count($message->getAttachments()),
                'synced_at' => now(),
            ]);

            foreach ($message->getAttachments() as $attachment) {
                $filename = $attachment->getName();
                $path = 'emails/' . $mail->id . '/' . $filename;

                Storage::put($path, $attachment->getContent());

                $mail->attachments()->create([
                    'filename' => $filename,
                    'mime_type' => $attachment->getMimeType(),
                    'size' => $attachment->getSize(),
                    'path' => $path,
                ]);
            }
        }

        $this->info('Sincronización completada.');
    }

    public function extraerCorreosValidos($message)
    {
        return collect($message)
            ->map(function ($addr) {
                if (is_string($addr) && filter_var($addr, FILTER_VALIDATE_EMAIL)) {
                    return $addr;
                }

                if (is_object($addr) && property_exists($addr, 'mail') && filter_var($addr->mail, FILTER_VALIDATE_EMAIL)) {
                    return $addr->mail;
                }

                return null;
            })
            ->filter()
            ->unique() // ← elimina duplicados
            ->values()
            ->toArray();
    }
}
