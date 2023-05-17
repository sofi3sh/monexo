<?php

namespace App\Models;

use App\Models\Admin\SuggestionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suggestion extends Model
{
    protected $table = 'suggestions';

    protected $fillable = [
        'title',
        'text',
        'user_id',
        'is_moderated',
        'type_id'
    ];

    protected $casts = [
        'title' => 'string',
        'text' => 'string',
        'user_id' => 'integer',
        'is_moderated' => 'boolean',
        'type_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Алиас на метод user() для удобства
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->user();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SuggestionType::class, 'type_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(SuggestionLike::class, 'suggestion_id', 'id');
    }

    public function likedUsers() : belongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'suggestion_likes',
            'suggestion_id',
            'user_id'
        )->withPivot('is_positive');
    }
}
