@extends('layouts.admin')

@section('content')


    <div class="dropdown">
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




    <h2 class="text-center">Все заявки пользователей</h2>
    <table class="table table-info table-borderless ajTable">
        <tr>
            <th>№</th>
            <th class="noneB" >Имя</th>
            <th>Телефон</th>
            <th>Почта</th>
            <th>Услуга</th>
            <th>Статус</th>
            <th>Изменить статус</th>
            <th>Удалить</th>
        </tr>
        <tr>
            @foreach($bidAdmin as $bid)
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

                <td>{{ $bid->id }}</td>
                <td class="noneB">{{ $bid->name }}</td>
                <td>{{ $bid->number }}</td>
                <td>{{ $bid->email }}</td>
                <td>{{ $bid->comm }}</td>


                <td  class="{{$st}} text-center text-white fw-bold fs-6 pt-3">{{ $bid->status }}</td>
                @if($bid->status == "Новая")
                    <td style="display: flex; flex-direction: row;  ">

                        <form style="margin-left: 45px;" enctype="multipart/form-data" action="{{ route('admin.bidOR.edit', $bid->id) }}"
                              method="put">
                            @csrf
                            @method('put')
                            <button onclick="return confirm('Перевести заявку в обработку?')" type="submit" class="m-0 p-2 border-0 btn-warning rounded  fw-bold">
                                Обработать
                            </button>
                        </form>
                        <form action="{{ route('admin.bidOR.show',  $bid->id) }}"
                              method="put">
                            @csrf
                            @method('put')
                            <button onclick="return confirm('Отклонить заявку?')" type="submit" class="m-0 p-2 border-0 btn-danger rounded r fw-bold">
                                Отклонить
                            </button>
                        </form>
                    </td>
                @elseif($bid->status == "Отклонено" || $bid->status == "Выполнено" )
                    <td>
                        <form style="margin-left: 45px;" action="{{ route('admin.bidOR.edit', $bid->id) }}"
                              method="put">
                            @csrf
                            @method('put')
                            <button onclick="return confirm('Перевести заявку в обработку?')" type="submit" class="m-0 p-2 border-0 btn-warning text-white rounded g fw-bold">
                                Обработать
                            </button>
                        </form>
                    </td>
                @else
                    <td style="display: flex; flex-direction: row; ">

                        <form action="{{ route('admin.editD', ['bidOR' => $bid->id ]) }}"
                        method="put">
                        @csrf
                        @method('put')
                        <button onclick="return confirm('Выполнить заявку?')" type="submit" class="m-0 p-2 border-0 btn-success rounded fw-bold">
                            Выполнить
                        </button>
                        </form>
                        <form action="{{ route('admin.bidOR.show', $bid->id) }}"
                              method="put">
                            @csrf
                            @method('put')
                            <button onclick="return confirm('Отклонить заявку?')" type="submit" class="m-0 p-2 border-0 btn-danger rounded fw-bold">
                                Отклонить
                            </button>
                        </form>
                    </td>

                @endif
                <td>
                    <form style="" action="{{ route('admin.bidOR.destroy',  $bid->id) }}"
                          method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Удалить заявку?')" type="submit" class="m-0 p-2 border-0  rounded g fw-bold">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                </td>
        </tr>
        @endforeach


    </table>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.product_sorting_btn').click(function () {
                let orderBy = $(this).data('order');
                $('.sorting_text').text($(this).find('span').text())
                $.ajax({
                    url: "{{route('admin.bidOR.index')}}",
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
