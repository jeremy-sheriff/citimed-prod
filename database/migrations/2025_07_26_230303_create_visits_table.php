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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->longText('complaints');
            $table->string('history_of_presenting_illness');
            $table->longText('allergies')->nullable();
            $table->longText('physical_examination');
            $table->longText('lab_test');
            $table->longText('imaging');
            $table->longText('diagnosis');
            $table->string('type_of_diagnosis');
            $table->longText('prescriptions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
