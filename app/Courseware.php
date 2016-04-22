<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courseware extends Model
{

    use SoftDeletes;
    /**
     *
     * deleted_at  软删除
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
