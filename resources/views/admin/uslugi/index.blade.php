@extends('layouts.admin')


@section('content')

    <script>
        const showModelEdit = () => {

            $(document).ready(function(e) {
                $('#exampleModal2').modal('show')

            })


        }

    </script>

    @if ($uslug = Session::get('infUser'))
        <script>showModelEdit()</script>
    @endif



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="">


                        <form method="post" enctype="multipart/form-data" action="{{ route('admin.uslug.store') }}">
                            @csrf
                            @method('POST')
                            <h1 class="mb-4">Добавление услуги</h1>

                            <div class="form-group">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Название усулги"
                                       required maxlength="255" value="{{ old('name') ?? '' }}" >
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
             <textarea id="desc" class="form-control" name="desc" placeholder="Описание услуги"
                       maxlength="255" rows="2">{{ old('desc') ?? '' }}</textarea>
                                @if ($errors->has('desc'))
                                    <span class="text-danger">{{ $errors->first('desc') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <input id="price" class="form-control" name="price" placeholder="Цена услуги"
                                       maxlength="255" rows="2" value="{{ old('price') ?? '' }}">
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <input id='imageUs' type="file" name="imageUs" class="form-control{{ $errors->has('imageUs') ? ' is-invalid' : '' }}" >
                                @if ($errors->has('imageUs'))
                                    <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('imageUs') }}</strong>
              </span>
                                @endif
                            </div>
                            <br>

                            <div class="form-group d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-success bg-primary">Добавить услугу</button>

                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>





    @if (Session::get('infUser'))

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$uslug->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="">

                        <form method="post" enctype="multipart/form-data" action="{{ route('admin.uslug.update', $uslug->id) }}">
                            @csrf
                            @method('PUT')
                            <h1 class="mb-4">Изменение услуги</h1>

                            <div class="form-group">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Название усулги"
                                       required maxlength="255" value="{{$uslug->name}}" >
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div><br>
                            <div class="form-group">
             <textarea id="desc" class="form-control" name="desc" placeholder="Описание услуги"
                       maxlength="255" rows="2">{{ $uslug->desc }}</textarea>
                                @if ($errors->has('desc'))
                                    <span class="text-danger">{{ $errors->first('desc') }}</span>
                                @endif
                            </div><br>
                            <div class="form-group">
                                <input id="price" class="form-control" name="price" placeholder="Цена услуги"
                                       maxlength="255" rows="2" value="{{$uslug->price}}">
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div><br>
                            <div class="form-group">
                                <input id='imageUs' type="file" name="imageUs" class="form-control{{ $errors->has('imageUs') ? ' is-invalid' : '' }}" >
                                @if ($errors->has('imageUs'))
                                    <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('imageUs') }}</strong>
              </span>
                                @endif
                            </div><br>


                            <div class="form-group" style="justify-content: center; display: flex; align-items: center">
                                <button type="submit" class="btn btn-success bg-primary">Изменить</button>
                            </div>
                        </form>


                    </div>


                </div>

            </div>
        </div>
    </div>

    @endif





    <h2 class="text-center">Все услуги компании</h2>
    <table class="table table-info table-borderless d-flex justify-content-center">
        <div style="display: flex; justify-content: center; margin: 10px 0 10px 0;">

            <a  class="btn btn-primary fw-bold cl" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Создать услугу</a>
        </div>






        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Изображение</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>
        @foreach($UslugiAdmin as $Uslugi)
            <tr>
                <td>{{ $Uslugi->id }}</td>
                <td>{{ $Uslugi->name }}</td>
                <td style="max-width: 400px">{{ $Uslugi->desc }}</td>
                <td>{{ $Uslugi->price }}</td>
                <td><a href="/storage/image/{{$Uslugi->imageUs}}">Изображение</a></td>



                <td>
                    <a  class="btn btn-success fw-bold" href="{{route('admin.uslug.edit', $Uslugi->id)}}"   role="button"><i class="fas fa-edit"></i></a>

                </td>
                <td><form style="" action="{{ route('admin.uslug.destroy', $Uslugi->id) }}"
                        method="post"  >
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Удалить заявку?')" type="submit" class="border-0 mt-1" style="background: #cff4fc">
                            <i class="fa-solid fa-trash text-danger fs-4"></i>
                        </button>
                    </form></td>
            </tr>
        @endforeach
    </table>



    <style>
        form{
            background: white;
            padding: 50px;
            border-radius: 5px;
        }
        .form-group{
            margin: 5% 0 0 0;
        }
        .form-group > button{
            margin: 5% 0 0 23%;
            font-weight: bold;
            font-size: 17px;

        }
        .form-group > input {
            max-width: 400px;
        }
    </style>



@endsection
