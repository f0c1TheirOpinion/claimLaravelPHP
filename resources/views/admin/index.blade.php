@extends('layouts.admin')

@section('content')
    <div class="container mt-4" id="ush" >
        <h2 class="text-center mb-4">Статистика сайта</h2>
        <div class="row row-cols-4 ushRow"  style=";">

                <div class="col ush">
                    <h3>Пользователи</h3>
                   <h4>{{$countUsers}}</h4>
                </div>
            <div class="col ush">
                <h3>Заявки</h3>
                <h4>{{$countBids}}</h4>
            </div>
            <div class="col ush">
                <h3>Решенные</h3>
                <h4>{{$countBidsD}}</h4>
            </div>

        </div>
    </div>
@endsection
