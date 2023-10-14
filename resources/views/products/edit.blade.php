@extends('index')
@section('content')
    <div class="container-fluid py-0">
        <form class="form-horizontal" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h4 class="card-title">
                    @if (is_null($item->id))
                        Create
                    @else
                        Update
                    @endif
                    product
                </h4>
                <input type="hidden" name="id" value="{{ @$item->id }}">
                <div class="row flex-column">
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="form-group row">
                            <label class="col-sm-3 text-end control-label col-form-label" for="">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id">

                                    <option value="">Choose category</option>
                                    @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}"
                                            {{ $item->category && old('category_id', $item->category->id) == $cate->id ? 'selected' : '' }}>
                                            {{ $cate->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    @foreach ($errors->get('category_id') as $error)
                                        <span class="text-danger"> {!! $error !!} </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
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
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="form-group row">
                            <label class="col-sm-3 text-end control-label col-form-label" for="">Unit</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="unit">
                                    <option value="">Choose unit</option>
                                    @foreach ($units as $unit)
                                        <option {{ old('unit', $item->unit) == $unit ? 'selected' : '' }}
                                            value="{{ $unit }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit'))
                                    @foreach ($errors->get('unit') as $error)
                                        <span class="text-danger"> {!! $error !!} </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="form-group row">
                            <label class="col-sm-3 text-end control-label col-form-label" for="">Price</label>
                            <div class="col-sm-9">
                                <input name="price"
                                    value=" {{ old('price') ? old('price') : number_format($item->price, 0, ',', '.') }} "
                                    type="price" class="form-control" placeholder="Enter price">
                                @if ($errors->has('price'))
                                    @foreach ($errors->get('price') as $error)
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
