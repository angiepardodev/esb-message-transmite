<?php

use App\Models\Message;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('message_depends', function (Blueprint $table) {
            $table->id();
            $table->string('chain_tenant');
            $table->string('chain_ref');
            $table->foreignIdFor(Message::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('message_depends');
    }
};
