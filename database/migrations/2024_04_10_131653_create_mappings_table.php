<?php

use App\Models\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::create('mappings', function (Blueprint $table) {
            $table->id();
            $table->jsonb('source_data')->comment(<<<'COMMENT'
                Stores the source data in a flexible JSONB format.
                This column can contain a variety of data types and structures,
                from simple key-value pairs to more complex objects.
                It represents the data or value before being mapped or transformed.
                COMMENT
            );
            $table->jsonb('mapped_data')->comment(<<<'COMMENT'
                Contains the destination data as a result of the mapping,
                stored in JSONB format. This column accommodates various data types and structures,
                reflecting the transformed or mapped version of the source data.
                It's designed for flexibility in storing the output of diverse mappings
                COMMENT
            );
            $table->foreignIdFor(Collection::class, 'collection_id')
                ->nullable()
                ->comment('Group this mapping belongs to');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('mappings');
    }
};
