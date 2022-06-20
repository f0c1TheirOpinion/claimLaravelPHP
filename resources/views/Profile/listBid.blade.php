@extends('layouts.app')


@section('content')
    <div class="dropdown mt-4">
        <span class="">Сортировка по:</span>

        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-order="default" aria-expanded="false">
            <span class="sorting_text">В порядке добавления</span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li class="product_sorting_btn dropdown-item" data-order="default" ><span>В порядке добавления</span></li>
            <li class="product_sorting_btn dropdown-item"  data-order="new"><span>Новые</span></li>
            <li class="product_sorting_btn dropdown-item"  data-order="waitMake"><span>В обработке</span></li>
            <li class="product_sorting_btn dropdown-item" data-order="decided"><span>Выполнены</span></li>
            <li class="product_sorting_btn dropdown-item" data-order="rejected"><span>Отклонены</span></li>
        </ul>
    </div>

    <h2 class="text-center text-white">Мои зявки</h2>
    <div class="bd-example">
        <table class="table table-info table-borderless ajTable">
            <tr>
                <th class="noneB">№</th>
                <th class="noneB" >Имя</th>
                <th class="noneB">Телефон</th>
                <th class="noneB">Почта</th>
                <th>Услуга</th>
                <th class="noneB">Комментарий</th>
                <th class="text-center">Статус</th>
            </tr>

                @foreach($bids as $bid)
                <tr>
                    @php
                        if($bid->status == 'Обработка'){
                        $st = 'bg-warning';
                            }elseif ($bid->status == 'Отклонено'){
                            $st='bg-danger';
                            }elseif ($bid->status == 'Выполнено'){
                            $st='bg-success';
                            }else{
                            $st='bg-primary';
                            }
                    @endphp

                    <td class="noneB">{{ $bid->id }}</td>
                    <td class="noneB">{{ $bid->name }}</td>
                    <td class="noneB">{{ $bid->number }}</td>
                    <td class="noneB">{{ $bid->email }}</td>
                    <td>{{ $bid->uslug }}</td>

                    <td class="noneB">{{ $bid->comm }}</td>
                    <td class="{{$st}} text-white fw-bold text-center">{{ $bid->status }}</td>

                @if($bid->status == "Новая")
                    <td>   <form style="" action="{{ route('profileUser.destroy',  $bid->id) }}"
                                 method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Удалить заявку?')" type="submit" class="m-0 p-2 border-0  rounded g fw-bold">
                                <i class="fa-solid fa-trash text-danger"></i>
                            </button>
                        </form></td>
                    @endif
                </tr>
        @endforeach

        </table>
    </div>

@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.product_sorting_btn').click(function () {
                let orderBy = $(this).data('order');
                $('.sorting_text').text($(this).find('span').text())
                $.ajax({
                    url: "{{route('profileUser.index')}}",
                    type:"GET",
                    data:{
                        orderBy:orderBy,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        $('.ajTable').html(data);
                    }
                });
            })
        })
    </script>

@endsection

