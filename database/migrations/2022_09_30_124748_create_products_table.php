<?php

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class, 'category_id');
            $table->string('tur');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->decimal('price')->nullable();
            $table->decimal('old_price');
            $table->integer('stok');
            $table->string('image');
            $table->boolean("is_active")->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
