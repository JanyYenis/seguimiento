<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->unique();
            $table->unsignedBigInteger('uid')->index();
            $table->string('folder')->default('INBOX');
            $table->string('subject')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email');
            $table->json('to')->nullable();
            $table->json('cc')->nullable();
            $table->json('bcc')->nullable();
            $table->dateTime('date')->nullable();
            $table->boolean('is_seen')->default(false);
            $table->json('flags')->nullable();
            $table->longText('body_text')->nullable();
            $table->longText('body_html')->nullable();
            $table->boolean('has_attachments')->default(false);
            $table->integer('attachments_count')->default(0);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
