
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoices->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        #container {
            margin: 0 auto;
            padding: 40px;
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding-bottom: 60px; /* Added padding to the bottom */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e8e5f7;
        }

        .total {

            text-align: left;
        }

        .invoice-header {
            text-align: right;
            font-size: 14px;
        }

        h2 {
            text-align: right;
            margin-bottom: 20px;
        }

        .head {
            text-align: center;
        }

        .discount {
            font-size: 14px;
        }

        .logo {
            float: left;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div id="container">
        <img src="C:\project954374\resources\views\vivalogo.png" alt="vivalogo" width="130" height="130" class="logo">
        <h2>Invoice</h2>

        <table>
            <tr>
                <td>
                    <strong>Viva Skin, Inc.</strong><br>
                    12345 Mueang Chiangmai<br>
                    Chiangmai, TH 12345
                </td>
                <td>
                    <div class="invoice-header">
                        <strong>Invoice Number:</strong> {{ $invoices->invoice_number }}<br>
                        <strong>Receipt Date:</strong> {{ $invoices->invoice_date }}
                    </div>
                </td>
            </tr>
        </table>

        <table>
            <tr class="head">
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Net Price</th>
            </tr>
            @foreach ($sale_order as $row)
                <tr>
                    <td>{{ $row->product_name }}</td>
                    <td>{{ $row->unit_price }}</td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->quantity * $row->unit_price }}</td>
                </tr>
            @endforeach
        </table>

        <table>
            <tr>
                <td colspan="2" class="total">
                    <strong>Subtotal:</strong> {{ $invoices->total_amount }} ฿<br>
                    @if ($memberships->membership_type == "standard")
                        <strong>Discount:</strong> {{ $memberships->discount_rate }}%<br>
                        <strong>Discount Price:</strong> - {{ ($invoices->total_amount) * ($memberships->discount_rate / 100) }} ฿<br>
                        @php $dis1 = (($invoices->total_amount) - ($invoices->total_amount) * ($memberships->discount_rate / 100)); @endphp
                    @else
                        <strong>Discount:</strong> {{ $memberships->discount_rate }}%<br>
                        <strong>Discount Price:</strong> - {{ ($invoices->total_amount*0.05) }} ฿<br>
                        @php $dis1 = ($invoices->total_amount-($invoices->total_amount*0.05)); @endphp
                    @endif

                    @if (($invoices->total_amount) >= 2000)
                        <strong>Additional Discount:</strong> 10%<br>
                        <strong>Discount Price:</strong> - {{ ($invoices->total_amount) * (10 / 100) }} ฿<br>
                        @php $dis2 = ($invoices->total_amount) * 0.1; @endphp
                        <strong>Total:</strong> {{ $dis1 - $dis2 }} ฿
                    @else
                        <strong>Total:</strong> {{ $dis1 }} ฿
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
