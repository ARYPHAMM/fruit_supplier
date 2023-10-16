@extends('index')
@section('content')
    <div class="container-fluid py-0">
        <div class="row">
            <div class="col-12">
                <div class="my-1">
                    <a href="{{ route('orders.edit') }}" class="btn btn-success color-white">
                        Add new
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    
                                    <td>{{ number_format($item->total, 0, ',', '.')
                                         }}</td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a class="d-block" href="{{ route('orders.show', ['order' => $item->id]) }}">
                                                <i class="fa fa-eye mx-3" aria-hidden="true"></i>
                                            </a>
                                            <a class="d-block" href="{{ route('orders.edit', ['order' => $item->id]) }}">
                                                <i class="fas  fa-edit    text-warning"></i>
                                            </a>
                                           
                                            <form onsubmit="return confirm('Are you sure');" 
                                                action="{{ route('orders.destroy', ['order' => $item->id]) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn">
                                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center flex-wrap">
                        {{ $items->onEachSide(5)->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
