<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Question extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'subject_id', 'grade_id', 'title', 'content', 'status', 'moderation_status'
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function subject() { return $this->belongsTo(Subject::class); }
    public function grade() { return $this->belongsTo(Grade::class); }
    public function answers() { return $this->hasMany(Answer::class); }
    public function tags() { return $this->belongsToMany(Tag::class, 'question_tags'); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function votes() { return $this->hasMany(Vote::class); }
    public function follows() { return $this->hasMany(QuestionFollow::class); }
}