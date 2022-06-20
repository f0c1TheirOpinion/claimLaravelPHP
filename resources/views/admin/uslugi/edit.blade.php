@extends('layouts.admin')


@section('content')
    <div style="display: flex; justify-content: center; align-items: center;">


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
                <button type="submit" class="btn btn-success bg-primary">Добавить услугу</button>
            </div>
        </form>
    </div>
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
