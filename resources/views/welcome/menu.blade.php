@extends('layouts.welcome')
@section('content')

    @include('welcome_partials.banner', ['title' => ' مدیریت منو'])

    <form class="p-5" action="{{url('/welcome_page/menu')}}" method="post">
        <p class="h3 dinar text-info mb-4"> مدیریت منو </p>

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <p class="h5 d-inline mt-3">
            <a class="cloner pointer">
                منو
                <i class="fa fa-plus text-info mt-1 mr-2"></i>
            </a>
        </p>

        <div class="clone-box">
            @foreach ($menus as $key => $menu)
                <div class="row to-be-cloned">
                    <fieldset class="form-group col-md-1 p-3 text-center">
                        <a class="delete-cloned pointer"><i class="fa fa-trash fa-2x mt-4 text-danger"></i></a>
                    </fieldset>
                    <fieldset class="form-group col-md-1 p-3">
                        <label> شماره </label>
                        <input name="number[]" value="{{$menu->number}}" type="text" class="form-control">
                    </fieldset>
                    <fieldset class="form-group col-md-3 p-3">
                        <label> نام </label>
                        <input name="name[]" value="{{$menu->name}}" type="text" class="form-control">
                    </fieldset>
                    <fieldset class="form-group col-md-2 p-3">
                        <label> آیکون </label>
                        <input name="icon[]" value="{{$menu->icon}}" type="text" class="form-control">
                    </fieldset>
                    <fieldset class="form-group col-md-2 p-3">
                        <label> هدف </label>
                        <select class="form-control" name="target[]">
                            <option value="" {{!$menu->target ? 'selected' : null}}> [بدون هدف] </option>
                            @foreach ($layouts as $key => $layout)
                                <option value="{{$layout->puzzle->latin_id}}" {{$layout->puzzle->latin_id == $menu->target ? 'selected' : ''}}>
                                    {{$layout->puzzle->title}}
                                    ({{$layout->puzzle->latin_id}})
                                </option>
                            @endforeach
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-3 p-3">
                        <label> لینک </label>
                        <input name="link[]" value="{{$menu->link}}" type="text" class="form-control">
                    </fieldset>
                </div>
            @endforeach
        </div>


        <div class="row">
            <div class="col-md-5"></div>
            <button type="submit" class="btn btn-primary form-control col-md-2"> تایید </button>
        </div>
    </form>

@endsection
