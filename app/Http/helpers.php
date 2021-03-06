<?php

//dates


//authenticating

function user_type()
{
    return auth()->user()->type;
}

function admin()
{
    $type = auth()->user()->type ?? null;
    return $type && auth()->user()->type == 'admin';
}

function regular()
{
    $type = auth()->user()->type ?? null;
    return $type && auth()->user()->type == 'regular';
}

//retrieve

function cities()
{
    return \DB::table('cities')->get();
}

function city($id)
{
    $city = \DB::table('cities')->where('id',$id)->first();
    return $city->name ?? '?';
}

function services()
{
    return \App\ServiceType::orderBy('position')->get();
}

//translate
function translate($word)
{
    switch ($word) {
        case 'room': return 'سالن'; break;
        case 'catering': case 'caterings': return 'پذیرایی'; break;
        case 'medium': case 'media': return 'خدمات سمعی بصری'; break;
        case 'graphic': case 'graphics': return 'خدمات گرافیکی'; break;
        case 'informing': case 'informings': return 'خدمات روابط عمومی'; break;
        case 'admin': return 'ادمین'; break;
        case 'regular': return 'عادی'; break;
        default: return $word; break;
    }
}

function week_day($day)
{
    if($day==0) return "شنبه";
    if($day==1) return "یکشنبه";
    if($day==2) return "دوشنبه";
    if($day==3) return "سه شنبه";
    if($day==4) return "چهارشنبه";
    if($day==5) return "پنجشنبه";
    if($day==6) return "جمعه";
    return '?';
}

function latin_week_day($day)
{
    if($day==1) return "دوشنبه";
    if($day==2) return "سه شنبه";
    if($day==3) return "چهارشنبه";
    if($day==4) return "پنجشنبه";
    if($day==5) return "جمعه";
    if($day==6) return "شنبه";
    if($day==7) return "یکشنبه";
    return '?';
}

//texts

function toman($amount)
{
    return $amount ? number_format($amount)." تومان" : 0;
}

function discount($amount,$discount=0)
{
    return $amount - ($discount*$amount)/100;
}

function str_with_dots($string,$number=100)
{
    return strlen($string) > $number ? mb_substr($string, 0, $number, 'utf-8').'...' : $string;
}
function display_time($time)
{
    return substr($time, 0, -3);
}

function period_details($id,$date=null)
{
    $period = \App\Period::find($id); if(!$period) return '?';
    if($date){
        return week_day($period->day->number) .' '. human_date($date) .' ساعت '. display_time($period->from) .' تا '.  display_time($period->till);
    }else {
        return week_day($period->day->number) .' ساعت '. display_time($period->from) .' تا '.  display_time($period->till);
    }
}

//random string
function rs($length = 10) {
    $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//other
function class_name($string)
{
    return '\App\\'.str_replace('_', '', ucwords($string, '_'));
}
