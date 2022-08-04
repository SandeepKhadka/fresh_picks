<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'summary', 'slug', 'is_parent', 'parent_id', 'status', 'image', 'added_by'];

    public function parent_info(){
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function rules($act = 'add')
    {
        $rule =  [
            'title' => 'required|string',
            'summary' => 'nullable|string',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|max:5120'
        ];
        if ($act == 'update'){
            $rule['image'] = 'sometimes|image|max:5120';
        }

        return $rule;
    }

    public function getSlug($title){
        $slug = Str::slug($title);
        if ($this->where('slug',$slug)->count() > 0){
            $slug .= date('Ymdhis').rand(0,99);
        }
        return $slug;
    }
}
