@extends('layouts.app')
@section('content')
    <div class="">
        <span class="h2 text-blue"> کدتخفیف های ثبت شده در سیستم </span>
        <a href="{{url("discounts/create")}}" class="float-left"> <i class="fa fa-plus ml-1"></i> اضافه کردن مورد جدید </a>
    </div>
    <hr>
    <div class="direct-x">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead>
                <tr>
                    <th> ردیف </th>
                    <th> عنوان </th>
                    <th> سالن </th>
                    <th> کد </th>
                    <th> درصد </th>
                    <th> تاریخ انقضا </th>
                    <th colspan="2"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($codes as $key => $code)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {!! $code->title ? '<strong>' : '<em>' !!} {{$code->title ?? '[بدون عنوان]'}} {!! $code->title ? '</strong>' : '</em>' !!} </td>
                        <td> {{$code->room->name ?? '-'}} </td>
                        <td> {{$code->code}} </td>
                        <td> {{$code->percent}} </td>
                        <td> {{ $code->expire_date ? human_date($code->expire_date) : '-' }} </td>
                        <td> <a href="{{url("discounts/$code->id/edit")}}"> <i class="fa fa-edit text-success"></i> </a> </td>
                        <td>
                             <a onclick="if(confirm('ایا این آیتم پاک شود؟')) $('form#delete-discount-{{$code->id}}').submit()" >
                                 <i class="fa fa-trash text-danger"></i>
                             </a>
                             <form class="d-none" action="{{url("discounts/$code->id")}}" method="post" id="delete-discount-{{$code->id}}">
                                 @csrf
                                 {{method_field('DELETE')}}
                             </form>
                         </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
