@extends('index')
@section('content')
    <div class="container-fluid py-0">
        <div class="row">
            <div class="my-1">
                <button type="button" onclick="exportPDF()" class="btn btn-danger d-inline-block">
                    Export PDF
                </button>
            </div>
            <table id="pdf" class="table table-bordered p-1 m-2">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>{{ $item->customer_name }}</th>
                        <th colspan="5"></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Fruit</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->orderDetails as $index => $value)
                        <tr>
                            <td scope="row">{{ $index + 1 }}</td>
                            <td>{{ $value->category_name }}</td>
                            <td>{{ $value->product_name }}</td>
                            <td>{{ $value->unit }}</td>
                            <td>{{ number_format($value->price, 0, ',', '.') }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>{{ number_format($value->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td>
                            Total
                        </td>
                        <td>
                            {{ number_format($item->total, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script>
        var exportPDF = () => {
          html2canvas(document.getElementById('pdf'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("order-{{$item->customer_name}}.pdf");
                }
            });
        }
    </script>
@endsection
