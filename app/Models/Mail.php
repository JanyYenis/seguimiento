<?php

namespace App\Models;

use App\Classes\Models\Model;

class Mail extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const LEIDO    = 1;
    const NO_LEIDO = 0;

    const INBOX = 'INBOX';

    public $table = 'mails';

    protected $fillable = [
        'message_id',
        'uid',
        'folder',
        'subject',
        'from_name',
        'from_email',
        'to',
        'cc',
        'bcc',
        'date',
        'is_seen',
        'flags',
        'body_text',
        'body_html',
        'has_attachments',
        'attachments_count',
        'synced_at',
    ];

    protected $casts = [
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'flags' => 'array',
        'is_seen' => 'boolean',
        'has_attachments' => 'boolean',
        'date' => 'datetime',
        'synced_at' => 'datetime',
    ];

    public function attachments()
    {
        return $this->hasMany(MailAttachment::class);
    }
}
