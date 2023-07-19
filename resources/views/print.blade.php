<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            margin: 1vw;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 1vw;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-image {
            width: 40%;
            max-width: 200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            color: #657119;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="logo-container">
            <img src="https://bloomskin.clinic/images/home/bloom-skin-clinic-logo.png" alt="Logo" class="logo-image">
        </div>

        <table>
            <tr>
                <th width="50%" style="text-align: left;">
                    <h1>Invoice</h1>
                </th>
                <th width="50%" style="text-align: right;">
                    <h3>Invoice ID: {{ $invoice->invoice_id }}</h3>
                </th>
            </tr>

            <tr>
                <td><strong>Appointment ID:</strong></td>
                <td style="text-align: right;">{{ $invoice->appointment_id }}</td>
            </tr>
            <tr>
                <td><strong>Total:</strong></td>
                <td style="text-align: right;">{{ $invoice->total }}</td>
            </tr>
            <tr>
                <td><strong>Payment Type:</strong></td>
                <td style="text-align: right;">{{ $invoice->payment_type }}</td>
            </tr>
            <tr>
                <td><strong>Pay Amount:</strong></td>
                <td style="text-align: right;">{{ $invoice->pay_amount }}</td>
            </tr>
            <tr>
                <td><strong>Balance:</strong></td>
                <td style="text-align: right;">{{ $invoice->balance }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td style="text-align: right;">{{ $invoice->status }}</td>
            </tr>
        </table>
    </div>

    <script>
        // JavaScript code for printing the page
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
