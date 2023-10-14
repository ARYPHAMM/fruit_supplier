@extends('index')
@section('content')
    <div class="container-fluid py-0">
        <div class="row">
            <div class="col-12">
                <div class="my-1">
                    <a href="{{ route('categories.edit') }}" class="btn btn-success color-white">
                        Add new
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">

                                        <a href="{{ route('categories.edit', ['category' => $item->id]) }}">
                                            <i class="fas mx-1 fa-edit    text-warning"></i>
                                        </a>
                                        <form onsubmit="return confirm('Are you sure');" class=" mx-1"
                                            action="{{ route('categories.destroy', ['category' => $item->id]) }}"
                                            method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        </div>
                                        {{-- <a onclick="return confirm('Bạn chắc chắn xóa?')"
                                            href="{{ route('admin-delete-category', ['id' => $item->id]) }} ">
                                            <i class="fa mx-1 fa-trash text-danger" aria-hidden="true"></i>
                                        </a> --}}
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
