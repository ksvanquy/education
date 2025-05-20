<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notification extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'question_id', 'answer_id', 'type', 'content', 'is_read'
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function question() { return $this->belongsTo(Question::class); }
    public function answer() { return $this->belongsTo(Answer::class); }
}
