<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
        use SoftDeletes;
        public function user()
        {
            return $this->belongsTo(\App\Models\User::class);
        }
        // The columns listed here can be saved using create() or update()
        protected $fillable = [
            'title',
            'description',
            'status',
            'due_date',
        ];
}
