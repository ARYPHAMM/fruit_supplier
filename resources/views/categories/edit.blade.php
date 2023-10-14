@extends('index')
@section('content')
    <div class="container-fluid py-0">
        <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h4 class="card-title">
                    @if (is_null($item->id))
                        Create
                    @else
                        Update
                    @endif
                    category
                </h4>
                <input type="hidden" name="id" value="{{ @$item->id }}">
                <div class="row flex-column">
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input name="name" value="{{ old('name', $item->name) }}" type="text"
                                    class="form-control" placeholder="Enter name">
                                @if ($errors->has('name'))
                                    @foreach ($errors->get('name') as $error)
                                        <span class="text-danger"> {!! $error !!} </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" type="button" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
