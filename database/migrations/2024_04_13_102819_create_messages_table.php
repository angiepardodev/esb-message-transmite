<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class, 'service_id');
            $table->json('signal');
            $table->string('chain_tenant')->nullable();
            $table->string('chain_ref')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->index(['chain_tenant', 'chain_ref']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
