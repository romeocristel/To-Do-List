<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Policies\TaskPolicy;
use App\Models\Task;

class Task extends Model
{
    protected $fillable = ['title', 'is_completed', 'user_id'];

    protected $casts= ['is_completed' => 'boolean'];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    // public function boot(): void 
    // {
    //     Gate::policy(Task::class, TaskPolicy::class);
    // }
}
