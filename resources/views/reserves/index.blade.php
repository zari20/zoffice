@extends('layouts.app')
@section('content')
    <p class="h2 text-blue"> لیست رزرو ها </p>
    <hr>
    <div class="direct-x">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead>
                <tr>
                    <th> ردیف </th>
                    <th> شماره تماس کاربر </th>
                    <th> اتاق </th>
                    <th> پذیرایی </th>
                    <th> خدمات صوتی تصویری </th>
                    <th> خدمات گرافیکی </th>
                    <th> خدمات اطلاع رسانی </th>
                    <th> کد تخفیف </th>
                    <th> مجموع هزینه ها </th>
                    <th> قابل پرداخت </th>
                    <th colspan="2"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reserves as $key => $reserve)
                    <tr>
                        <th scope="row"> {{$key+1}} </th>
                        <td> {{$reserve->user->mobile ?? '?'}} </td>
                        <td> {{$reserve->schedule->room->name ?? '?'}} </td>
                        <td> @include('fragments.cor', ['var' => count($reserve->caterings)]) </td>
                        <td> @include('fragments.cor', ['var' => count($reserve->media)]) </td>
                        <td> @include('fragments.cor', ['var' => count($reserve->graphics)]) </td>
                        <td> @include('fragments.cor', ['var' => count($reserve->informings)]) </td>
                        <td> {{ $reserve->discount_code_id ? ($reserve->discount->code ?? '?') : '-'}} </td>
                        <td> {{toman($reserve->total_cost)}} </td>
                        <td> {{$reserve->payable_amount ? toman($reserve->payable_amount) : toman($reserve->total_cost)}} </td>
                        <td>
                            <a href="{{url("reserves/$reserve->id")}}" title="مشاهده"> <i class="fa fa-eye text-info"></i></a>
                        </td>
                        {{-- <td>
                            <a href="{{url("reserves/$reserve->id/edit")}}" title="ویرایش"> <i class="fa fa-edit text-success"></i></a>
                        </td> --}}
                        <td>
                             <a onclick="if(confirm('ایا این آیتم پاک شود؟')) $('form#delete-reserve-{{$reserve->id}}').submit()" title="حذف">
                                 <i class="fa fa-trash text-danger"></i>
                             </a>
                             <form class="d-none" action="{{url("reserves/$reserve->id")}}" method="post" id="delete-reserve-{{$reserve->id}}">
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
