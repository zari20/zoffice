<?php

function rw($value)
{
    return strtolower(str_replace('App\Welcome\Welcome','',$value));
}

function calculate_cols($count)
{
    switch ($count) {
        case 1: return 12; break;
        case 2: return 6; break;
        case 3: return 4; break;
        case 4: return 3; break;
        case 5: return 3; break;
        case 6: return 2; break;
        case 7: return 3; break;
        case 8: return 3; break;
        case 9: return 4; break;
        default: return 12; break;
    }
}

function welcome_translate($word)
{
    switch ($word) {
        case '5col': return '5 ستونه'; break;
        case 'slider': return 'اسلایدر'; break;
        case 'blog': return 'بلاگ'; break;
        case 'image': return 'عکس چهارتایی'; break;
        case 'image_cadr': return 'عکس چهارتایی با کادر'; break;
        case 'download': return 'دانلود فایل 4 ستونه'; break;
        case 'product': return 'محصول چهارتایی'; break;
        case 'link': return 'لینک چهارتایی'; break;
        default: return $word; break;
    }
}

function carousel_indicators($array)
{
    $count = count($array);
    if($count%4==0){
        return ($count/4)-1;
    }else {
        return floor($count/4);
    }
}

function prepare_multiple($inputs)
{
    $result = [];

    foreach ($inputs as $key => $array) {
        if(is_array($array) && count($array)){
            foreach ($array as $i => $value) {
                $result[$i][$key] = $value;
            }
        }
    }

    return $result;
}
