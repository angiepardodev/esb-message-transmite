<?php

use App\Models\Mapping;
use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transformation_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(Mapping::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transformation_mapping');
    }
};
