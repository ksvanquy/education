<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Answer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'question_id', 'user_id', 'content', 'is_accepted'
    ];
    public function question() { return $this->belongsTo(Question::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function votes() { return $this->hasMany(Vote::class); }
}
