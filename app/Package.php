<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public static function getRecordWithSlug($slug)
    {
        return Package::where('slug', '=', $slug)->first();
    }
}
