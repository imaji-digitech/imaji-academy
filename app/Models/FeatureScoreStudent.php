<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $feature_score_id
 * @property int $score_practice
 * @property int $score_theory
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property FeatureScore $featureScore
 * @property User $user
 */
class FeatureScoreStudent extends Model
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
    protected $fillable = ['student_id', 'feature_score_id', 'score_status', 'score', 'score_practice', 'score_theory', 'note', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function featureScore()
    {
        return $this->belongsTo('App\Models\FeatureScore');
    }

    /**
     * @return BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
