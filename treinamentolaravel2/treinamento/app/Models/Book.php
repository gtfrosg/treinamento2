<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'goodreads_book_id',
        'best_book_id',
        'work_id',
        'books_count',
        'isbn13',
        'authors',
        'original_publication_year',
        'original_title',
        'title',
        'language_code',
        'average_rating',
        'ratings_count',
        'work_text_reviews_count',
        'ratings_1',
        'ratings_2',
        'ratings_3',
        'ratings_4',
        'ratings_5',
        'image_url',
        'small_image_url',
    ];
}
