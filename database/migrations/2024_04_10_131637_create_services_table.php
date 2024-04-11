<?php

use App\Models\Application;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->jsonb('endpoint_parameters')->comment('url, headers, and metadata for the fetch endpoint');
            $table->jsonb('callback_parameters')->comment('url, headers, and metadata for the fetch callback');
            $table->foreignIdFor(Application::class, 'application_origin_id');
            $table->foreignIdFor(Application::class, 'application_destination_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['application_origin_id', 'application_destination_id', 'slug']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
