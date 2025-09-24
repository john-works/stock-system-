<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - {{ $sale->receipt_no }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }

        .receipt {
            max-width: 850px;
            background-color: #fff;
            margin: auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.07);
        }

        .receipt-header {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        .receipt-header h1 {
            font-weight: 700;
            font-size: 30px;
            margin-bottom: 5px;
            color: #0d6efd;
        }

        .receipt-header p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }

        .receipt-title {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 25px;
            color: #495057;
            border-top: 2px dashed #ced4da;
            border-bottom: 2px dashed #ced4da;
            padding: 10px 0;
        }

        .details p {
            font-size: 14px;
            margin: 3px 0;
        }

        .table {
            font-size: 14px;
            margin-top: 20px;
        }

        .table thead {
            background-color: #f8f9fa;
            color: #343a40;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .totals {
            text-align: right;
            font-size: 16px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
        }

        .signature-line {
            width: 200px;
            margin: 20px auto 10px;
            border-top: 1px solid #000;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background-color: #fff;
                padding: 0;
            }

            .receipt {
                box-shadow: none;
                border: none;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<div class="receipt">
    <div class="receipt-header text-center">
        <h1>Mukisa Shop</h1>
        <p>Email: info@myshop.com | Tel: +256-000-000000</p>
    </div>

    <div class="receipt-title">SALE RECEIPT</div>

    <div class="row details mb-4">
        <div class="col-md-6">
            <p><strong>Receipt No:</strong> {{ $sale->reciept_no }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d') }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            {{-- @if(!empty($sale->customer_name))
                <p><strong>Customer:</strong> {{ $sale->name }}</p>
                <p><strong>Phone:</strong> {{ $sale->phone }}</p>
            @endif --}}
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price (UGX)</th>
                <th>Subtotal (UGX)</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($sale->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->item_name ?? 'N/A' }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @php $grandTotal += $item->subtotal; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p><strong>Total:</strong> <span class="text-primary">{{ number_format($grandTotal, 2) }} UGX</span></p>
    </div>

    <div class="footer">
        <p class="mt-5"><strong>Thank you for your purchase!</strong></p>
        <div class="signature-line"></div>
        <p><small>Authorized Signature</small></p>
    </div>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-success">Print</button>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

</body>
</html>
