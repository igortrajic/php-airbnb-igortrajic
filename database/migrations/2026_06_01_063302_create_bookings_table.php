<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();                                        
            $table->string('status', 20);                         
            $table->date('check_in');                             
            $table->date('check_out');                            
            $table->decimal('total_price', total: 8, places: 2);   
            $table->foreignId('id_user')                          
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->foreignId('apartment_id')                     
                  ->constrained('apartments')
                  ->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};