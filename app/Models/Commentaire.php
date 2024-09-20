<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

  
    protected $table = 'commentaires';

  
    protected $fillable = [
        'contenu',
        'user_id',
        'article_id',
        'blog_id',
    ];

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the article that this comment is associated with.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the blog that this comment is associated with.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
