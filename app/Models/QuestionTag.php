<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class QuestionTag extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $primaryKey = null;
    protected $fillable = ['question_id', 'tag_id'];
}
