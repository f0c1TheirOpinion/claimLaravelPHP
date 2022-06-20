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
