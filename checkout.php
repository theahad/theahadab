<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script> <!-- Include jsPDF library -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        .checkout-form, .order-summary {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
            border-radius: 8px;
            animation: slideIn 1s ease-in-out;
        }
        .checkout-form {
            flex: 2;
        }
        .order-summary {
            flex: 1;
            max-width: 400px;
        }
        .checkout-form h2, .order-summary h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group input[type="checkbox"] {
            width: auto;
        }
        .form-group .btn {
            color: blue;
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
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .order-summary ul li:last-child {
            border-bottom: none;
        }
        .order-summary .total {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 10px;
        }
        .order-summary .remove-btn {
            cursor: pointer;
            color: red;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 10px;
            }
            .checkout-form, .order-summary {
                max-width: 100%;
                padding: 10px;
            }
            .form-group input,
            .form-group select,
            .form-group textarea {
                border-top: 1px solid #ccc;
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .success-message, .error-message {
            display: none;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="checkout-form" id="checkout-form">
            <h2 style="color:#911955; font-weight:bold;">Delivery</h2>
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="work-phone">Work Phone No.</label>
                <input type="tel" id="work-phone" name="work-phone" required>
            </div>
            <div class="form-group">
                <label for="cell-phone">Cell No.</label>
                <input type="tel" id="cell-phone" name="cell-phone" required>
            </div>
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="Category A">Category A</option>
                    <option value="Category B">Category B</option>
                    <option value="Category C">Category C</option>
                    <!-- Add more categories as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks (other additional information)</label>
                <textarea id="remarks" name="remarks"></textarea>
            </div>
            <button id="submitBtn" type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; color: #fff; padding: 10px 20px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
            <button id="generateBillBtn" style="background-color: #007bff; border-color: #007bff; color: #fff; padding: 10px 20px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer; display: none;" class="btn btn-primary" onclick="generateBill()">
    <a href="invoice.php" target="_blank" style="color: white; text-decoration: none;">Generate Bill</a>
</button>
            <div class="success-message" id="success-message">Your order has been sent successfully!</div>
            <div class="error-message" id="error-message">Please fill out all required fields.</div>
        </form>
        <div class="order-summary">
            <h2 style="color:#911955; font-weight:bold;">Order Summary</h2>
            <ul id="checkoutItemList" class="checkout-item-list">
                <!-- Product items will be dynamically added here -->
            </ul>
            <div class="total">
                <span>Total</span>
                <span id="totalAmount">Rs 0.00 PKR</span>
            </div>
        </div>        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const orderSummaryList = document.getElementById('checkoutItemList');
            let subtotal = 0;

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
                        <span class="remove-btn" onclick="removeItem(${index})">❌</span>
                    `;
                    orderSummaryList.appendChild(orderItem);
                    subtotal += parseFloat(item.price.replace('Rs ', '').replace(',', '')) * item.quantity;
                });

                const subtotalItem = document.createElement('li');
                subtotalItem.innerHTML = `
                    <span>Subtotal</span>
                    <span>Rs ${subtotal.toFixed(2)} PKR</span>
                `;
                orderSummaryList.appendChild(subtotalItem);

                const totalAmountElement = document.getElementById('totalAmount');
                totalAmountElement.textContent = `Rs ${subtotal.toFixed(2)} PKR`;
            }

            renderOrderSummary();

            window.removeItem = function(index) {
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                renderOrderSummary();
            };

            const checkoutForm = document.getElementById('checkout-form');
            checkoutForm.addEventListener('submit', function(event) {
                event.preventDefault();

                if (checkoutForm.checkValidity()) {
                    document.getElementById('error-message').style.display = 'none';
                    document.getElementById('success-message').style.display = 'block';
                    document.getElementById('submitBtn').style.display = 'none';
                    document.getElementById('generateBillBtn').style.display = 'inline-block';
                    checkoutForm.reset();
                } else {
                    document.getElementById('error-message').style.display = 'block';
                    checkoutForm.reportValidity();
                }
            });

            function generateBill() {
                // Generate PDF
                const doc = new jsPDF();
                
                // Add content to PDF
                const checkoutDetails = `
                    Name: ${document.getElementById('name').value}
                    Address: ${document.getElementById('address').value}
                    Email: ${document.getElementById('email').value}
                    Work Phone No.: ${document.getElementById('work-phone').value}
                    Cell No.: ${document.getElementById('cell-phone').value}
                    Date Of Birth: ${document.getElementById('dob').value}
                    Category: ${document.getElementById('category').value}
                    Remarks: ${document.getElementById('remarks').value}
                `;
                doc.text(checkoutDetails, 10, 10);

                // Save PDF
                const filename = 'checkout_details.pdf';
                doc.save(filename);

                // Reset cart and UI
                localStorage.removeItem('cart');
                renderOrderSummary();
                document.getElementById('success-message').style.display = 'none';
                document.getElementById('generateBillBtn').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'inline-block';
            }
        });


        document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const checkoutDetails = {
            name: document.getElementById('name').value,
            address: document.getElementById('address').value,
            email: document.getElementById('email').value,
            workPhone: document.getElementById('work-phone').value,
            cellPhone: document.getElementById('cell-phone').value,
            dob: document.getElementById('dob').value,
            category: document.getElementById('category').value,
            remarks: document.getElementById('remarks').value,
        };

        localStorage.setItem('checkoutDetails', JSON.stringify(checkoutDetails));

        document.getElementById('generateBillBtn').style.display = 'inline-block';
        document.getElementById('submitBtn').style.display = 'none';
    });
    </script>
</body>
</html>
