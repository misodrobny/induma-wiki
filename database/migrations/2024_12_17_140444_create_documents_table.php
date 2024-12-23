<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('disk');
            $table->string('stored_path');
            $table->string('stored_filename');
            $table->string('original_filename');
            $table->json('json_data')->nullable();
            $table->string('llama_cloud_id')->nullable();
            $table->string('llama_cloud_status')->nullable();
            $table->string('llama_cloud_job_metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
