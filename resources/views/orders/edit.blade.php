@extends('index')
@section('content')
    <div class="container-fluid py-0">
        <form class="form-horizontal" method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h4 class="card-title">
                    @if (is_null($item->id))
                        Create
                    @else
                        Update
                    @endif
                    order
                </h4>
                <input type="hidden" name="order_id" value="{{ @$item->id }}">
                <div id="form-1" class="row flex-column">
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="card border my-2" v-for="item,index in selected_products" :key="index">
                            <div class="d-none">
                                <input type="hidden" :name="`order_details[${index}][id]`" :value="item.id">
                                <input type="hidden" :name="`order_details[${index}][product_id]`"
                                    :value="item.product_id">
                                <input type="hidden" :name="`order_details[${index}][quantity]`" :value="item.quantity">
                                <input type="hidden" :name="`order_details[${index}][product_name]`"
                                    :value="item.name">
                                <input type="hidden" :name="`order_details[${index}][price]`"
                                    :value="item.price">
                                <input type="hidden" :name="`order_details[${index}][unit]`" :value="item.unit">
                                <input type="hidden" :name="`order_details[${index}][category_name]`"
                                    :value="item.category_name">
                            </div>
                            <div class="card-body">
                                <div>
                                    Name: <span v-html="item.name"></span>
                                </div>
                                <div>
                                    Price: <span v-html="`${number_format(item.price, 0, ',', '.')}`"></span>
                                </div>
                                <div>
                                    Unit: <span v-html="item.unit"></span>
                                </div>
                                <div>
                                    Quantity: <input type="number" v-model="item.quantity"
                                        class="form-control hidden-number-arrow" min="0">
                                </div>
                                <div>
                                    Amount:
                                    <span v-html="(number_format(item.quantity*item.price, 0, ',', '.'))"></span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button v-on:click="remove(index)" type="buttom" class="btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div v-if="total">
                            <b>Total:</b> <span v-html="(number_format(total, 0, ',', '.'))"></span>
                        </div>
                    </div>
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="form-group row">
                            <label class="col-sm-3 text-end control-label col-form-label" for="">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id" v-on:change="handlerCategory">
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
                            <label class="col-sm-3 text-end control-label col-form-label" for="">Product</label>
                            <div class="col-sm-9">
                                <select class="form-control" v-on:change="handlerProduct">
                                    <option value="">Choose product</option>
                                    <option :value="item.id" v-for="item,index in items" :key="index"
                                        v-html="`Name: ${item.name}, unit: ${item.unit}, price: ${number_format(item.price, 0, ',', '.')}`">
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-block m-auto col-12">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 text-end control-label col-form-label">Customer
                                name</label>
                            <div class="col-sm-9">
                                <input name="customer_name" value="{{ old('customer_name', $item->customer_name) }}"
                                    type="text" class="form-control" placeholder="Enter customer name">
                                @if ($errors->has('customer_name'))
                                    @foreach ($errors->get('customer_name') as $error)
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
    <script>
       var form =  new Vue({
            data() {
                return {
                    items: [],
                    selected_products: []
                }
            },
            computed: {
                total() {
                    let total = 0;
                    this.selected_products.forEach(item => {
                        total += (item.quantity * item.price);
                    })
                    return total;
                }
                
            },
            methods: {
                number_format(number, decimals, dec_point, thousands_sep) {
                    number = number * 1; //makes sure `number` is numeric value
                    var str = number.toFixed(decimals ? decimals : 0).toString().split('.');
                    var parts = [];
                    for (var i = str[0].length; i > 0; i -= 3) {
                        parts.unshift(str[0].substring(Math.max(0, i - 3), i));
                    }
                    str[0] = parts.join(thousands_sep ? thousands_sep : ',');
                    return str.join(dec_point ? dec_point : '.');
                },
                async handlerCategory($event) {
                    this.items = [];
                    if ($event.target.value.length)
                        await axios({
                            method: "get",
                            url: "{{ route('products.index.json') }}",
                        })
                        .then((res) => {
                            this.items = res.data.data;
                        })
                        .catch((error) => {});
                },
                handlerProduct($event) {
                    if ($event.target.value.length) {
                        let item = this.items.find((item) => item.id == $event.target.value);
                        this.selected_products.push(item);
                        let index = this.selected_products.length - 1;
                        this.$set(this.selected_products[index], 'quantity', 1);
                        this.$set(this.selected_products[index], 'product_id', item.id);
                        this.$set(this.selected_products[index], 'id', null);
                        this.$set(this.selected_products[index], 'category_name', item.category?item.category.name : '');
                    }
                },
                remove(location) {
                    this.selected_products = this.selected_products.filter((item, index) => index !== location);
                }
            },
        }).$mount('#form-1');

        <?php foreach(old('order_details',$order_details) as $key1 => $val1){ ?>
            form.selected_products.push({
                id: "{{ $val1['id'] }}",
                name: "{{ $val1['product_name'] }}",
                product_id: "{{ $val1['product_id'] }}",
                category_name: "{{ $val1['category_name'] }}",
                price: "{{ $val1['price'] }}",
                unit: "{{ $val1['unit'] }}",
                quantity: "{{ $val1['quantity'] }}"
            })
        <?php } ?>
    </script>
@endsection
