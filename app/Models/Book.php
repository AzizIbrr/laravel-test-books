<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'title',
        'serial_number',
        'published_at',
        'author_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
