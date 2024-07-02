<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 20px;
        }
        .details-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .details-container h2 {
            color: #911955;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .details-item {
            margin-bottom: 15px;
        }
        .details-item label {
            font-weight: bold;
        }
        .order-summary {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .order-summary ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .order-summary ul li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .order-summary ul li:last-child {
            margin-bottom: 0;
        }
        .order-summary .total {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 10px;
        }
        button {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:focus,
        button:hover {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <h2>Checkout Details</h2>
        
        <div class="details-item">
            <label>Name:</label>
            <span id="name"></span>
        </div>
        
        <div class="details-item">
            <label>Address:</label>
            <span id="address"></span>
        </div>
        
        <div class="details-item">
            <label>Email:</label>
            <span id="email"></span>
        </div>
        
        <div class="details-item">
            <label>Work Phone No.:</label>
            <span id="work-phone"></span>
        </div>
        
        <div class="details-item">
            <label>Cell No.:</label>
            <span id="cell-phone"></span>
        </div>
        
        <div class="details-item">
            <label>Date Of Birth:</label>
            <span id="dob"></span>
        </div>
        
        <div class="details-item">
            <label>Category:</label>
            <span id="category"></span>
        </div>
        
        <div class="details-item">
            <label>Remarks:</label>
            <span id="remarks"></span>
        </div>

        <!-- Order Summary Section -->
        <div class="order-summary">
            <h2>Order Summary</h2>
            <ul id="checkoutItemList" class="checkout-item-list">
                <!-- Product items will be dynamically added here -->
            </ul>
            <div class="total">
                <span>Total</span>
                <span id="totalAmount"></span>
            </div>
        </div>

        <button onclick="window.print()">Print Details</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const checkoutDetails = JSON.parse(localStorage.getItem('checkoutDetails'));
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const orderSummaryList = document.getElementById('checkoutItemList');
        let subtotal = 0;

        document.getElementById('name').textContent = checkoutDetails.name;
        document.getElementById('address').textContent = checkoutDetails.address;
        document.getElementById('email').textContent = checkoutDetails.email;
        document.getElementById('work-phone').textContent = checkoutDetails.workPhone;
        document.getElementById('cell-phone').textContent = checkoutDetails.cellPhone;
        document.getElementById('dob').textContent = checkoutDetails.dob;
        document.getElementById('category').textContent = checkoutDetails.category;
        document.getElementById('remarks').textContent = checkoutDetails.remarks;

        function renderOrderSummary() {
            orderSummaryList.innerHTML = '';
            subtotal = 0;
            
            cart.forEach((item, index) => {
                const orderItem = document.createElement('li');
                orderItem.innerHTML = `
                    <div>
                        <img src="${item.image}" alt="${item.title}" style="width: 50px; height: auto; margin-right: 10px;">
                        <span>${item.title} (x${item.quantity})</span>
                        <span>${item.price}</span>
                    </div>
                `;
                orderSummaryList.appendChild(orderItem);
                subtotal += parseFloat(item.price.replace('Rs ', '').replace(',', '')) * item.quantity;
            });

            const subtotalItem = document.createElement('li');
            subtotalItem.innerHTML = `
                <div>
                    <span>Subtotal</span>
                    <span>Rs ${subtotal.toFixed(2)} PKR</span>
                </div>
            `;
            orderSummaryList.appendChild(subtotalItem);

            const totalAmountElement = document.getElementById('totalAmount');
            totalAmountElement.textContent = `Rs ${subtotal.toFixed(2)} PKR`;
        }

        renderOrderSummary();
    });
    </script>
</body>
</html>
