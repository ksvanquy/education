<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'question_id', 'answer_id', 'content'
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function question() { return $this->belongsTo(Question::class); }
    public function answer() { return $this->belongsTo(Answer::class); }
}
