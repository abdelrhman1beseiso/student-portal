<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('courses', function (Blueprint $table) {
        // Check if course_id exists and remove it if it's causing problems
        if (Schema::hasColumn('courses', 'course_id')) {
            $table->dropColumn('course_id');
        }
        
        // Ensure id column is properly set as primary key
        if (!Schema::hasColumn('courses', 'id')) {
            $table->id()->first();
        }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
