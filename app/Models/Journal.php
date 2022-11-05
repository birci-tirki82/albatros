<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "product_id",
        "publisher_id",
        "isbn",
        "language",
        "pages",
        "type",
        "paper_type",
        "dimensions",
        "feature",
        "publish_date",
    ];

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
