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
        
        Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
    $table->string('title');
    $table->string('slug')->unique(); // Also make slug unique
    $table->float('price');
    $table->float('dis_price')->nullable();
    $table->boolean('is_stock')->default(0);
    $table->boolean('status')->default(1);
    $table->longText('description')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
   

//     public function up(): void
//     {
//         Schema::create('products', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
//             $table->string('title');
//             $table->string('slug')->unique();
//             $table->decimal('price', 10, 2); // Better for currency
//             $table->decimal('dis_price', 10, 2)->nullable(); // Better for currency
//             $table->boolean('is_stock')->default(1); // Default to "in stock"
//             $table->boolean('status')->default(1);
//             $table->longText('description')->nullable();
//             $table->timestamps();
//         });
//     }

    
//     public function down(): void
//     {
//         Schema::dropIfExists('products');
//     }
// };