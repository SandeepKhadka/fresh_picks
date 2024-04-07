<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'status', 'image', 'added_by'];

    public function rules($act = 'add')
    {
        $rule =  [
            'title' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|max:5120'
        ];
        if ($act == 'update'){
            $rule['image'] = 'sometimes|image|max:5120';
        }

        return $rule;
    }
}
