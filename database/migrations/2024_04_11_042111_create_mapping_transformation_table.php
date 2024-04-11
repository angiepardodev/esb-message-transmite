<?php

use App\Models\Mapping;
use App\Models\Transformation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mapping_transformation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Transformation::class);
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
