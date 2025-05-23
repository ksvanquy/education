<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class QuestionFollow extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $primaryKey = null;
    protected $fillable = ['user_id', 'question_id'];
}
