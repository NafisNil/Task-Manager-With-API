<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','is_done'];
    protected $casts = [
        'is_done' => 'boolean'
    ];
    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected static function booted() : void{
        static::addGlobalScope('creator', function(Builder $builder){
             return response()->json( Auth::user()->id, 200);
            $builder->where('creator_id', Auth::user()->id);
        });
    }
}
