<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $imaji_academy_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property ImajiAcademy $imajiAcademy
 * @property User $user
 */
class ImajiAcademyStudent extends Model
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
    protected $fillable = ['imaji_academy_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function imajiAcademy()
    {
        return $this->belongsTo('App\Models\ImajiAcademy');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
