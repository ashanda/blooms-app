<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <!-- Include any necessary CSS styles here -->
    <style>
        /* CSS styles for the invoice print page */
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>Invoice ID: {{ $invoice->invoice_id }}</h2>
    <p>Appointment ID: {{ $invoice->appoinment_id }}</p>
    <p>Total: {{ $invoice->total }}</p>
    <p>Payment Type: {{ $invoice->payment_type }}</p>
    <p>Pay Amount: {{ $invoice->pay_amount }}</p>
    <p>Balance: {{ $invoice->balance }}</p>
    <p>Status: {{ $invoice->status }}</p>

    <!-- Additional content, such as a print button or other relevant information -->

    <!-- Include any necessary JavaScript scripts here -->
    <script>
        // JavaScript code for printing the page
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
