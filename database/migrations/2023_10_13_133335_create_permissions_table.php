<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); //User A
            $table->string('title')->default('Registered User')->nullable();
            $table->boolean('create_update_post')->default(0);
            $table->boolean('create_update_reply')->default(1);
            $table->boolean('delete_post')->default(0);
            $table->boolean('delete_reply')->default(1);
            $table->boolean('delete_others_reply')->default(0); //Allows user A to delete User B's Reply 
            $table->boolean('delete_others_post')->default(0); //Allows user A to delete User B's Post
            $table->boolean('manage_others')->default(0); //Allows user A to CRUD user B
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('permissions');
        Schema::disableForeignKeyConstraints();
    }
};
