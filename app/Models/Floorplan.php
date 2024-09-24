<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class Floorplan extends Model
{
    use HasFactory;

    protected $table = 'floorplans';

    protected $fillable = [
        'id',
        'place',
        'floor',
        'path'
    ];

    public function getImage()
    {
        if (Storage::disk('public')->exists($this->path)) {
            $imageContent = Storage::disk('public')->get($this->path);
            return $imageContent;
        }

        abort(404, 'Image not found');
    }
}
