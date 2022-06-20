@extends('admin.uslugi.index')


@section('editUslug')
    <div>


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
    <style>


@endsection
