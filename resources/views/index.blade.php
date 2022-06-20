@extends('layouts.app')

<script type="application/javascript">
    const showModelEdit001 = () => {

        $(document).ready(function(e) {
            $('#exampleModal2').modal('show')

        })


    }

</script>



@section('content')





    @if ($bidCreate = Session::get('uslugBid') && $idBid = Session::get('infUser') )
        <script type="application/javascript">showModelEdit001()</script>
    @endif




    @if ($bidCreate = Session::get('uslugBid'))
        @php
            $idBid = Session::get('infUser');
        @endphp



        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" style="">
                <div class="modal-content" style="background: rgb(6 6 6 / 90%)">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="exampleModalLabel">{{$bidCreate->name}} </h5>
                        <button style="background: rgb(6 6 6 / 90%); border: none" type="button"  data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white fs-3"></i></button>
                    </div>
                    <div class="modal-body">
                        <div style="">

                            <form method="post" enctype="multipart/form-data" action="{{ route('saveBid.user', ['Bid' => $idBid]) }}">
                                @csrf
                                @method('POST')
                                <h1 class="mb-4 text-white">Оформление заявки</h1>

                                <div class="form-group">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Как к вам можно обращаться?"
                                           required maxlength="255" value="{{ old('name') ?? '' }}" >
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <br>


                                <div class="form-group">
                                    <input id="number" class="form-control" name="number" placeholder="Вам номер телефона"
                                           maxlength="255" rows="2" value="{{ old('number') ?? '' }}">
                                    @if ($errors->has('number'))
                                        <span class="text-danger">{{ $errors->first('number') }}</span>
                                    @endif
                                </div>
                                <br>

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Ваш Email"
                                           required maxlength="255" value="{{ old('email') ?? '' }}" >
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <br>

                                <div class="form-group">
                                    <select class="form-select" id="uslug" name="uslug" aria-label="Default select example">
                                        <option value="{{$bidCreate->name}}" selected>{{$bidCreate->name}}</option>

                                    </select>
                                    @if ($errors->has('uslug'))
                                        <span class="text-danger">{{ $errors->first('uslug') }}</span>
                                    @endif
                                </div>
                                <br>

                                <div class="form-group">
             <textarea id="comm" class="form-control" name="comm" placeholder="Комменатрий"
                       maxlength="255" rows="2">{{ old('comm') ?? '' }}</textarea>
                                    @if ($errors->has('comm'))
                                        <span class="text-danger">{{ $errors->first('comm') }}</span>
                                    @endif
                                </div>


                                <br>

                                <div class="form-group d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-success bg-primary fw-bold">Отправить заявку</button>

                                </div>
                            </form>


                        </div>


                    </div>

                </div>
            </div>
        </div>

        @php

       
        @endphp

    @endif












    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @for($i = 0; $i < count($Slider); $i++)

            @if($i == 0)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i}}"></button>

                @else
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i}}"></button>

                @endif

            @endfor

        </div>
        <div class="carousel-inner" id="index">
            @for($i = 0; $i < count($Slider); $i++)
            @if($i == 0)

                    <div class="carousel-item active" style="background-color: black;">
                        <img src="storage/image/{{$Slider[$i]->imageSlider}}" class="d-block w-100 slideStyle"   alt="...">
                        <div class="carousel-caption  d-md-block text-slider" style="">
                            <h2>{{$Slider[$i]->name}}</h2>
                            <p class="fs-5">{{$Slider[$i]->desc}}</p>
                            <a class="btn btn-primary" href="{{$Slider[$i]->linkBtn}}" role="button">{{$Slider[$i]->nameBtn}}</a>
                        </div>
                    </div>

                @else
                    <div class="carousel-item" style="background-color: black;">
                        <img src="storage/image/{{$Slider[$i]->imageSlider}}" class="d-block w-100 slideStyle"   alt="...">
                        <div class="carousel-caption d-md-block text-slider">
                            <h2>{{$Slider[$i]->name}}</h2>
                            <p class="fs-5">{{$Slider[$i]->desc}}</p>
                            <a class="btn btn-primary" href="{{$Slider[$i]->linkBtn}}" role="button">{{$Slider[$i]->nameBtn}}</a>

                        </div>
                    </div>
                @endif



            @endfor

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="container mt-4" id="uslug" >
        <h2 class="text-white text-center mb-4">Услуги компании</h2>
        <div class="row row-cols-4 uslRow" style="">
            @foreach($Uslugs as $Uslug)
            <div class="col usl">
                <h2>{{$Uslug->name}}</h2>
                <img src="storage/image/{{$Uslug->imageUs}}" alt="">
                <h6 class="text-white mt-2 fs-5">Цена: от {{$Uslug->price}}₽</h6>

                <p>{{$Uslug->desc}}</p>

                <div>
                <a class="btn btn-primary fw-bold" href="{{route('createBid.user', ['Bid' => $Uslug->id])}}"  role="button">Оставить заявку</a>
                </div>

            </div>
            @endforeach
        </div>
    </div>


    <div class="container " id="contacts">
        <h2 class="text-white text-center">Контакты компании</h2>
        <div class="d-flex justify-content-center align-items-center mp">

            <div class="text-white fs-5">
                <p><i class="fa fa-map-marker" aria-hidden="true"></i>
                    Адрес: пр. Автозаводцев, 43, Миасс, Челябинская обл., 456300
                </p>
                <p><i class="fa-solid fa-phone"></i> 8 (351) 355-00-33</p>
                <p><i class="fa-solid fa-envelope"></i> mgrk@autopodbor.ru</p>

            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2717.892169663557!2d60.106632657032364!3d55.052575759706315!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbf7d77b122b4dd9e!2z0JzQuNCw0YHRgdC60LjQuSDQs9C10L7Qu9C-0LPQvtGA0LDQt9Cy0LXQtNC-0YfQvdGL0Lkg0LrQvtC70LvQtdC00LY!5e0!3m2!1sru!2sru!4v1646687159454!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

        </div>
    </div>
    </div>


@endsection
