<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Attachment
 *
 * @property int $id
 * @property int $task_id
 * @property string $name
 * @property string $path
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Task $task
 *
 * @method static \Database\Factories\AttachmentFactory factory($count = null, $state = [])
 * @method static Builder|Attachment newModelQuery()
 * @method static Builder|Attachment newQuery()
 * @method static Builder|Attachment query()
 * @method static Builder|Attachment whereCreatedAt($value)
 * @method static Builder|Attachment whereId($value)
 * @method static Builder|Attachment whereName($value)
 * @method static Builder|Attachment wherePath($value)
 * @method static Builder|Attachment whereTaskId($value)
 * @method static Builder|Attachment whereType($value)
 * @method static Builder|Attachment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'name',
        'path',
        'type',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
