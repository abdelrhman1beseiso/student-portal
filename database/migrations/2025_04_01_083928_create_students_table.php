<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('dob');
            $table->string('address');
            $table->timestamps();
            $$table->string('student_id')->nullable(false)->change();
            $table->unique('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down()
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropUnique(['student_id']);
        $table->dropColumn('student_id');
    });
}
};
