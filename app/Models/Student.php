<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $school
 * @property int $class
 * @property string $hobby
 * @property string $future_goal
 * @property string $parent_name
 * @property string $parent_job
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Student extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'school', 'class', 'hobby', 'future_goal', 'parent_name', 'parent_job', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static
                ::whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ;
    }
}
