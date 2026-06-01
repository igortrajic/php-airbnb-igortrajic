<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();                                          
            $table->string('title', 50);                          
            $table->string('city', 50);                           
            $table->decimal('price_night', total: 8, places: 2);   
            $table->integer('max_guests');                         
            $table->decimal('size', total: 8, places: 2);         
            $table->foreignId('owner_id')                         
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};