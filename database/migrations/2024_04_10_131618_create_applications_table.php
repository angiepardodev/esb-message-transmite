<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->ulid('id', 2)->comment('Code unique for identify an application');
            $table->string('name')->comment('Name of the application');
            $table->string('url')->comment('Base URL of the application');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
