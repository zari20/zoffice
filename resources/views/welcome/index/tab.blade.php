@if ($title = $tab->title)
    @include('welcome_partials.title')
@endif
<section class="introduction about">
    @if($layout->container) <div class="container"> @endif
        <div class="row">
            <div class="tabs">
                <ul class="nav nav-pills mb-3 d-inline d-sm-flex" id="pills-tab" role="tablist">
                    @foreach ($tab->visible_sections() as $i => $section)
                        <li class="nav-item my-2 my-sm-0">
                            <a class="nav-link tab-pill {{ $i==0 ? 'active' : '' }}" id="{{$tab->id}}-{{$i}}-tab" data-toggle="pill" href="#{{$tab->id}}-{{$i}}" role="tab">
                                <small class="fa fa-circle ml-1"></small>
                                {{$section->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach ($tab->visible_sections() as $i => $section)
                        <div class="tab-pane fade show {{ $i==0 ? 'active' : '' }}" id="{{$tab->id}}-{{$i}}" role="tabpanel">
                            @if(false) <div id="slider-{{$section->id}}" class="carousel slide" data-ride="carousel"> @endif
                                @if ( false )
                                    <ol class="carousel-indicators">
                                        @for ($i=0; $i <= carousel_indicators(null); $i++)
                                            <li data-target="#slider-{{$section->id}}" data-slide-to="{{$i}}" {!! $i==0 ? 'class="active"' : '' !!}></li>
                                        @endfor
                                    </ol>
                                @endif
                                @if(false) <div class="carousel-inner"> @endif
                                    @for ($i=0; $i <= 0; $i++)
                                        <div class="carousel-item {!! $i==0 ? 'active' : '' !!}">
                                            @include('welcome.index.'.$section->type,compact('section'))
                                        </div>
                                    @endfor
                                @if(false) </div> @endif
                            @if(false) </div> @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if($layout->container) </div> @endif
</section>