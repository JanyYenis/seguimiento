<?php

namespace App\Models;

use App\Classes\Models\Model;

class MailAttachment extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'mail_attachments';

    protected $fillable = [
        'email_id',
        'filename',
        'mime_type',
        'size',
        'path',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }
}
