<div class="collapse" id="collapse{{ucfirst($type)}}" data-parent="#reserves-collapseable">

    @foreach (old($type)['id'] ?? [0] as $i => $id)
        <div id="{{$type}}-service-rows">
            <div class="row" data-service-type="{{$type}}" data-row="{{$i+1}}">
                <div class="form-group col-md-4 styled-select slate">
                    <label for="{{$type}}"> نوع {{translate($type)}} </label>
                    <select class="form-control" name="{{$type}}[id][]" id="{{$type}}" onchange="changeService($(this))">
                        @foreach ($services as $key => $service)
                            <option value="{{$service->id}}" data-cost="{{$service->cost}}" @if($id == $service->id) selected @endif>
                                {{$service->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="{{$type}}-count"> تعداد </label>
                    <input type="number" class="form-control" id="{{$type}}-count" name="{{$type}}[count][]" value="{{old($type)['count'][$i] ?? 0}}" onkeyup="changeCount($(this))" onchange="changeCount($(this))" data-type="{{$type}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="{{$type}}-final-cost"> <i class="fa fa-money ml-1"></i> هزینه به تومان </label>
                    <input type="text" class="form-control {{$type}}-final-cost" id="{{$type}}-final-cost" name="{{$type}}[cost][]" value="{{old($type)['cost'][$i] ?? 0}}" readonly>
                </div>
            </div>
        </div>
    @endforeach
    <div class="text-light text-center">
        <a onclick="removeServiceRow('{{$type}}')" class="btn btn-danger mx-1" id="{{$type}}-trash-icon" @if(count(old($type)['id'] ?? []) < 2) style="display:none" @endif>
            <i class="fa fa-times ml-1"></i> حذف مورد
        </a>
        <a onclick="newServiceRow('{{$type}}')" class="btn btn-success mx-1"> <i class="fa fa-plus ml-1"></i> اضافه کردن مورد جدید </a>
    </div>

    <div class="alert alert-info mt-3">
        @foreach ($services as $key => $service)
            <p class="{{$type}}-description" id="{{$type}}-description-{{$service->id}}" @if($key>0) style="display:none" @endif> {{$service->description}} </p>
        @endforeach
        <hr>
        <p>
            هزینه واحد:
            @foreach ($services as $key => $service)
                <span class="{{$type}}-cost" id="{{$type}}-cost-{{$service->id}}" @if($key>0) style="display:none" @endif> {{$service->cost}} </span>
            @endforeach
            تومان
        </p>
    </div>

    @if ($next)
        <hr>
        <button type="button" class="btn bg-blue" data-toggle="collapse" data-target="#collapse{{$next}}">
             مرحله بعدی <i class="fa fa-arrow-left mr-1"></i>
        </button>
    @endif

    <hr>
</div>
