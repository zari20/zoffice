<?php

namespace App\Welcome;

use Illuminate\Database\Eloquent\Model;

class WelcomePage extends Model
{
    protected $guarded = ['id'];

    public static function delete_others($numbers)
    {
        $items = self::all();
        foreach ($items as $key => $item) {
            if(!in_array($item->number,$numbers)){
                $item->delete();
            }
        }
    }

    public static function clean($section_id)
    {
        self::where('section_id',$section_id)->delete();
    }
}
