<?php

//use App\Models\Category;
use App\Models\Product;
use App\Models\Publisher;
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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Publisher::class, 'publisher_id');
            $table->foreignIdFor(Product::class, 'product_id');
            $table->date('publish_date');
            $table->string('isbn');
            $table->string('language');
            $table->integer('pages');
            $table->string('type');
            $table->string('paper_type');
            $table->string('dimensions');
            $table->string('feature');
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
        Schema::dropIfExists('journals');
    }
};
