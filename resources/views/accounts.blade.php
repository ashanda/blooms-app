<!DOCTYPE html>
<html>
<head>
    <title>Point of Sale Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .receipt {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h1 {
            margin: 0;
        }

        .receipt-details {
            margin-bottom: 20px;
        }

        .receipt-details .row {
            display: flex;
            justify-content: space-between;
        }

        .receipt-item-table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-item-table th,
        .receipt-item-table td {
            padding: 5px;
            border-bottom: 1px solid #ccc;
        }

        .receipt-total {
            text-align: right;
            margin-top: 20px;
        }

        .receipt-total strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h1>Point of Sale Receipt</h1>
        </div>

        <div class="receipt-details">
            <div class="row">
                <div>
                    <strong>Transaction ID:</strong> 123456
                </div>
                <div>
                    <strong>Date:</strong> January 1, 2023
                </div>
            </div>
        </div>

        <table class="receipt-item-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>$10.00</td>
                    <td>2</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>$15.00</td>
                    <td>1</td>
                    <td>$15.00</td>
                </tr>
                <tr>
                    <td>Product 3</td>
                    <td>$5.00</td>
                    <td>3</td>
                    <td>$15.00</td>
                </tr>
            </tbody>
        </table>

        <div class="receipt-total">
            <strong>Total: $50.00</strong>
        </div>
    </div>
</body>
</html>
