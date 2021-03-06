@extends('layouts.app')
@section('content')

    <p class="lead text-blue"> کاربران ثبت شده در سیستم  </p>
    <hr>
    <div class="direct-x">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead>
                <tr>
                    <th> ردیف </th>
                    <th> نام کاربری </th>
                    <th> ایمیل </th>
                    <th> موبایل </th>
                    <th> تلفن ثابت </th>
                    <th> شهر </th>
                    <th> منطقه شهری </th>
                    <th> آدرس </th>
                    <th> نوع کاربر </th>
                    <th colspan="5"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td> {{$key+1}} </td>
                        <td> {{$user->username ?? '-'}} </td>
                        <td> {{$user->email ?? '-'}} </td>
                        <td> {{$user->mobile ?? '-'}} </td>
                        <td> {{$user->telephone ?? '-'}} </td>
                        <td> {{$user->city_id ? city($user->city_id) : '-'}} </td>
                        <td> {{$user->region ?? '-'}} </td>
                        <td> {{$user->address ?? '-'}} </td>
                        <td> {{translate($user->type)}} </td>
                        <td> <a href="{{url("users/{$user->id}")}}" class="card-link none mx-1" title="مشاهده"> <i class="fa fa-eye ml-1"></i> </a> </td>
                        <td>
                            @if ($user->payment)
                                <a href="{{url("payments/{$user->payment->id}")}}" class="card-link none mx-1" title="مشاهده اطلاعات مالی">
                                    <i class="fa fa-credit-card ml-1"></i>
                                </a>
                            @elseif($user->type == 'admin')
                                <span class="cursor-help" title="این کاربر ادمین میباشد. اطلاعات مالی مختص به کاربران عادی میباشد."> - </span>
                            @else
                                <span class="cursor-help" title="این شخص هنوز اطلاعات مالی خود را ثبت نکرده است"> - </span>
                            @endif
                        </td>
                        <td> <a href="{{url("change_password/{$user->id}")}}" class="card-link text-warning none mx-1" title="تغییر رمز عبور"> <i class="fa fa-lock ml-1"></i> </a> </td>
                        <td> <a href="{{url("users/{$user->id}/edit")}}" class="card-link text-success none mx-1" title="ویرایش"> <i class="fa fa-edit ml-1"></i> </a> </td>
                        <td> @include('fragments.delete', ['object' => $user, 'name'=>'user']) </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{$users->links()}}
@endsection
