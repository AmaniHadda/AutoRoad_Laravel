<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #F5F5F5;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .invoice-details {
            width: 57%;
            display: inline-block;
            vertical-align: top;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-info {
            width: 40%;
            display: inline-block;
            vertical-align: top;
        }

        .invoice-info p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f0f0f0;
        }

        .navbar-brand {
            display: inline-block;
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container">
        <div >
            <h1 class="navbar-brand"><span style="color:orange">AUTO</span><span> ROAD</span></h1>
            <h1 style="text-align: center; font-family: 'Times New Roman', Times, serif;">Paiement Invoice</h1>
            <hr />
        </div><br /><br />
        <div class="invoice-details">
            <p><strong>Invoice Date:</strong>{{ $invoice->created_at->format('d/m/Y') }}</p>
            <p><strong>Customer Name:</strong>{{$name}}</p>
            <p><strong>Customer Email:</strong>{{$email}}</p> 
            <p><strong>Vehicle Model:</strong> {{$renting->vehicle->Model}}</p> 
            <p><strong>Vehicle Condition:</strong>{{$renting->vehicle->Vehicle_Condition}}</p>
        </div>
        <div class="invoice-info">
            <p><strong>Company Name:</strong> AUTO ROAD</p>
            <p><strong>Address:</strong> 123 Main Street,Tunis</p>
            <p><strong>Phone:</strong> (123) 456-7890</p>
            <p><strong>Email:</strong> info@autoroad.com</p>
        </div>
        <hr />
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Vehicle Model</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rent Fee</td>
                    <td>1</td>
                    <td>{{$renting->rentingPrice}}</td>
                    <td>{{$renting->rentingPrice}}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td>{{$renting->rentingPrice}}</td>
                </tr>
            </tfoot>
        </table>
        <hr />
        <div>THANK YOU FOR RENTING!</div>
    </div>
</body>

</html>