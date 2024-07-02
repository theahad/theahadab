<?php
// Import PHPMailer classes into the global namespace
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$messageSent = false;
$errorMessage = '';

$servername = "localhost:3309";
$dbusername = "root";
$dbpassword = "";
$dbname = "cosmetics_register_db";

// Connect to MySQL database
$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data (for security)
    $name = $mysqli->real_escape_string(htmlspecialchars($_POST['name']));
    $phone = $mysqli->real_escape_string(htmlspecialchars($_POST['phone']));
    $email = $mysqli->real_escape_string(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $message = $mysqli->real_escape_string(htmlspecialchars($_POST['message']));

    if ($email === false) {
        $errorMessage = "Invalid email format.";
    } else {
        // SQL query to insert data into 'contacts' table
        $sql = "INSERT INTO contacts (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";

        if ($mysqli->query($sql) === TRUE) {
            // Email sending using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'testahaddevs@gmail.com';
                $mail->Password = 'kjas izzz klvz luje'; // Use app-specific password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Sender information
                $mail->setFrom('ahadghanchi2003@gmail.com', 'Contact Form');

                // Recipient (from form input)
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Contact Form Submission';
                $mail->Body    = "Name: $name<br>Phone: $phone<br>Email: $email<br>Message: $message";
                $mail->AltBody = "Name: $name\nPhone: $phone\nEmail: $email\nMessage: $message";

                // Send email
                $mail->send();
                $messageSent = true;

            } catch (Exception $e) {
                $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                echo $errorMessage;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}


$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact Us</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;         
            flex-wrap: wrap;
            justify-content: center;
            margin: 0;
            padding-top: 70px; /* Add initial padding to avoid overlap with fixed navbar */
            transition: padding-top 0.3s ease; /* Smooth transition for padding change */
            box-sizing: border-box;
            background: #f9f9f9;
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #911955;
            padding: 10px 20px;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000; /* Ensure the navbar is above other content */
        }
        .navbar .logo img {
    height: 50px;
    width: 50px;
    border-radius: 50%;
}
        .nav-links {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            padding: 0 15px;
            position: relative; /* Ensure relative positioning for dropdown */
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .nav-links a:hover {
            color: #ff6347;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
        }
        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #575757;
        }
        .nav-links li:hover .dropdown-content {
            display: block;
        }
        .menu-btn {
            display: none; /* Hide by default on larger screens */
            cursor: pointer;
            color: #fff;
            font-size: 24px;
        }
        @media screen and (max-width: 768px) {
            .navbar {
                padding: 20px;
            }
            .nav-links {
                display: none;
                flex-direction: column;
                background-color: #333;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
            }
            .nav-links.active {
                display: flex;
            }
            .nav-links li {
                text-align: center;
                padding: 10px 0;
                width: 100%;
                position: static; /* Reset position for dropdown to work properly */
            }
            .nav-links li:hover .dropdown-content {
                display: block; /* Hide dropdown on mobile initially */
            }
            .menu-btn {
                display: block; /* Display the menu button on smaller screens */
                
            }
            body.menu-active {
                padding-top: calc(150px + 180px); /* Adjusted padding for menu height */
            }
        }

        @media screen and (max-width: 768px) {
            .navbar {
                
                padding: 20px;
                
            }

            .nav-links {
                display: none;
                flex-direction: column;
                background-color: #911955;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links li {
                text-align: center;
                padding: 10px 0;
                width: 100%;
                position: static; /* Reset position for dropdown to work properly */
            }

            .nav-links li:hover .dropdown-content {
                display: block; /* Hide dropdown on mobile initially */
            }

            .menu-btn {
                display: block; /* Display the menu button on smaller screens */
                margin-right:22px;
                
            }

            body.menu-active {
                padding-top: calc(150px + 180px); /* Adjusted padding for menu height */
            }
            
            .shopping-cart {
            margin-right:20px;
        }
        }


        .shopping-cart {
            color: white;
            font-size: 20px;
            cursor: pointer;
            position: relative;
        }

        .shopping-cart::before {
            content: '\1F6D2'; /* Unicode character for shopping cart */
        }


                .container {
    max-width: 1170px;
    margin: auto;
    width: 100%; /* Ensure the container stretches across the entire width */
}
.row {
    display: flex;
    flex-wrap: wrap;
    width: 100%; /* Ensure the row stretches across the entire width */
}
        ul {
            list-style: none;
        }
        .footer {
    background-color: #911955;
    padding: 70px 0; /* Keep the vertical padding as needed */
    width: 100%; /* Ensure the footer stretches across the entire width */
}
        
.footer-col {
    width: 25%; /* Adjust width based on the number of columns you want per row */
    padding: 0 15px;
    box-sizing: border-box; /* Include padding in the width calculation */
}
        .footer-col h4 {
            font-size: 18px;
            color: #ffffff;
            text-transform: capitalize;
            margin-bottom: 35px;
            font-weight: 500;
            position: relative;
        }
        .footer-col h4::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            background-color: #e91e63;
            height: 2px;
            box-sizing: border-box;
            width: 50px;
        }
        .footer-col ul li:not(:last-child) {
            margin-bottom: 10px;
        }
        .footer-col ul li a {
            font-size: 16px;
            text-transform: capitalize;
            color: white;
            text-decoration: none;
            font-weight: 300;
            display: block;
            transition: all 0.3s ease;
        }
        .footer-col ul li a:hover {
            color: #ffffff;
            padding-left: 8px;
        }
        .footer-col .social-links a {
            display: inline-block;
            height: 40px;
            width: 40px;
            background-color: rgba(225, 225, 225, 0.2);
            margin: 0 10px 10px 0;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: #ffffff;
            transition: all 0.2s ease;
        }
        .footer-col .social-links a:hover {
            color: #24262b;
            background-color: #ffffff;
        }

        @media (max-width: 767px) {
            .footer-col {
                width: 50%;
                margin-bottom: 30px;
            }
        }
        @media (max-width: 574px) {
            .footer-col {
                width: 100%;
            }
        }


        .side-menu {
    position: fixed;
    right: -300px; /* Hidden by default */
    top: 0;
    width: 300px;
    height: 100%;
    background-color: #f8f9fa;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
    transition: right 0.3s ease;
    padding: 20px;
    z-index: 1000;
    display: flex;
    flex-direction: column; /* Ensure items stack vertically */
}

.side-menu.open {
    right: 0;
}

.cart-message {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
    color: #333;
}

.cart-message button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    transition: background 0.3s ease;
    border-radius: 5px;
}

.cart-message button:hover {
    background-color: #218838;
}

.cart-items {
    flex: 1; /* Fill remaining space */
    overflow-y: auto; /* Scroll if items exceed space */
}

.cart-item {
    border-bottom: 1px solid #ccc;
    padding: 10px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-item img {
    max-width: 50px;
    margin-right: 10px;
}

.cart-item .item-details {
    display: flex;
    align-items: center;
}

.cart-item .item-details h4 {
    margin: 0;
    font-size: 16px;
}

.cart-item .item-details p {
    margin: 5px 0 0 0;
    font-size: 14px;
}

.remove-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    transition: background 0.3s ease;
    border-radius: 5px;
}

.remove-button:hover {
    background-color: #c82333;
}

.checkout-container {
    margin-top: auto; /* Pushes the checkout button to the bottom */
}

.checkout-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
    border-radius: 5px;
    width: 100%;
    max-width: 250px; /* Adjust max-width as needed */
}

.checkout-button:hover {
    background-color: #0056b3;
}



.close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    color: #000; /* Adjust color as needed */
}

.close-btn:hover {
    color: #dc3545; /* Change color on hover for better UX */
}
        .side-menu {
    position: fixed;
    right: -300px; /* Hidden by default */
    top: 0;
    width: 300px;
    height: 100%;
    background-color: #f8f9fa;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
    transition: right 0.3s ease;
    padding: 20px;
    z-index: 1000;
    display: flex;
    flex-direction: column; /* Ensure items stack vertically */
}

.side-menu.open {
    right: 0;
}


.contact {
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .contact .content {
            max-width: 800px;
            text-align: center;
            margin-bottom: 40px;
        }

        .contact .content h2 {
            font-size: 36px;
            font-weight: 500;
            color: #e91e63;
            margin-bottom: 10px;
        }

        .contact .content p {
            font-weight: 300;
            color: #555;
        }

        .container1 {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
        }

        .container1 .contactInfo,
        .contactForm {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 280px;
            max-width: 480px;
        }

        .contactInfo .box {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .contactInfo .box .icon {
            min-width: 60px;
            height: 60px;
            background: #e91e63;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 22px;
            color: #fff;
            margin-right: 15px;
        }

        .contactInfo .box .text {
            font-size: 16px;
            display: flex;
            flex-direction: column;
        }

        .contactInfo .box .text h3 {
            font-weight: 500;
            color: #e91e63;
            margin-bottom: 5px;
        }

        .contactForm h2 {
            font-size: 24px;
            color: #e91e63;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }

        .contactForm .inputBox {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .contactForm .inputBox input,
        .contactForm .inputBox textarea {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            border: none;
            border-bottom: 2px solid #e91e63;
            outline: none;
            background: transparent;
            color: #333;
        }

        .contactForm .inputBox span {
            position: absolute;
            left: 0;
            padding: 5px 0;
            font-size: 16px;
            pointer-events: none;
            transition: 0.5s;
            color: #666;
        }

        .contactForm .inputBox input:focus ~ span,
        .contactForm .inputBox input:valid ~ span,
        .contactForm .inputBox textarea:focus ~ span,
        .contactForm .inputBox textarea:valid ~ span {
            color: #e91e63;
            font-size: 12px;
            transform: translateY(-20px);
        }

        .contactForm .inputBox input[type="submit"] {
            background: #e91e63;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 18px;
            transition: background 0.3s;
        }

        .contactForm .inputBox input[type="submit"]:hover {
            background: #d81b60;
        }

        @media (max-width: 991px) {
            .container1 {
                flex-direction: column;
                align-items: stretch;
            }

            .container1 .contactInfo,
            .contactForm {
                width: 100%;
            }
        }

        .success-message, .error-message {
    display: none;
    padding: 15px 30px;
    border-radius: 5px;
    font-size: 16px;
    border-radius: 50px;
    font-family: 'Poppins', sans-serif; /* Apply the chosen font */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add a text shadow for better readability */
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    text-align: center;
    margin-top: 20px;
    animation: fadeIn 1s ease forwards;
}
        .success-message {
    background-color: #28a745;
    color: #fff;
        }

        .error-message {
    background-color: #dc3545;
    color: #fff;
}
.details-container img {
    display: block;
    margin: 0 auto 10px auto; /* Center the image and add bottom margin */
    max-width: 50px; /* Adjust width as needed */
    margin-top: 5px; 
    margin-left: 20px;
    height: auto; /* Maintain aspect ratio */
}
    </style>
</head>

<body>


<nav class="navbar">
<div class="details-container">
            <img src="1.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="jewelleryfront_index.php">Jewellery</a></li>
            
            <li><a href="contact_us.php">Contact</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
      
        <div class="menu-btn" onclick="toggleMenu()">&#9776;</div>
        
        <div class="shopping-cart" onclick="toggleCart()">

       
    </div>
        
    </nav>
 
    <!-- Side Menu for Shopping Cart -->
<div class="side-menu" id="sideMenu">
    <span class="close-btn" onclick="toggleCart()">×</span>
    <div class="cart-message" id="cartMessage">
        Your cart is empty
        <button onclick="toggleCart()">Continue Shopping</button>
    </div>
    <div class="cart-items" id="cartItems"></div>
    <div class="checkout-container">
        <button class="checkout-button" id="checkoutButton" onclick="checkout()">Checkout</button>
    </div>
</div>



<section class="contact">
    <div class="container1">
        <div class="contactForm">
            <h2>Contact Us</h2>
            <div id="response">
        
    </div>
            <form class="contact-form" action="contact_us.php" method="POST">
                <div class="inputBox">
                    <input type="text" id="name" name="name" required>
                    <span>Full Name</span>
                </div>
                <div class="inputBox">
                    <input type="tel" id="phone" name="phone" required>
                    <span>Phone</span>
                </div>
                <div class="inputBox">
                    <input type="email" id="email" name="email" required>
                    <span>Email</span>
                </div>
                <div class="inputBox">
                    <textarea id="message" name="message" rows="1" required></textarea>
                    <span>Type your message</span>
                </div>
                <div class="inputBox">
                    <input type="submit" name="submit" value="Send">
                </div>
            </form>
            <?php if ($messageSent): ?>
                <div class="success-message">Message has been sent successfully!</div>
                <script>
                    document.querySelector('.success-message').style.display = 'block';
                </script>
            <?php elseif (!empty($errorMessage)): ?>
                <div class="error-message"><?= $errorMessage ?></div>
                <script>
                    document.querySelector('.error-message').style.display = 'block';
                </script>
            <?php endif; ?>
        </div>
    </div>
</section>






<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="about.php">about us</a></li>
                        <li><a href="index.php">our service</a></li>
                        <li><a href="pp.php">privacy & policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="shipping.php">shipping</a></li>
                        <li><a href="return.php">returns</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>online shop</h4>
                    <ul>
                    <li><a href="index.php">Cosmetics</a></li>
                        <li><a href="jewelleryfront_index.php">Jewellery</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Custom JS -->
    <script>
 
function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
            const body = document.querySelector('body');
            body.classList.toggle('menu-active');
        }


        
   function toggleCart() {
    const sideMenu = document.getElementById('sideMenu');
    sideMenu.classList.toggle('open');
    updateCart();
}

function updateCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartMessage = document.getElementById('cartMessage');
    const cartItems = document.getElementById('cartItems');
    const checkoutButton = document.getElementById('checkoutButton');

    if (cart.length === 0) {
        cartMessage.style.display = 'block';
        cartItems.style.display = 'none';
        checkoutButton.style.display = 'none'; // Hide checkout button if cart is empty
    } else {
        cartMessage.style.display = 'none';
        cartItems.style.display = 'block';
        checkoutButton.style.display = 'block'; // Show checkout button if cart has items

        cartItems.innerHTML = '';

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <div class="item-details">
                    <img src="${item.image}" alt="${item.title}">
                    <div>
                        <h4>${item.title}</h4>
                        <p>Price: $${item.price}</p>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                </div>
                <button class="remove-button" data-id="${item.id}">Remove</button>
            `;
            cartItems.appendChild(cartItem);
        });

        // Add event listeners to remove buttons
        const removeButtons = cartItems.querySelectorAll('.remove-button');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = button.getAttribute('data-id');
                removeFromCart(productId);
            });
        });
    }
}

function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function checkout() {
    // Redirect to checkout page
    window.location.href = 'checkout.php'; // Replace with your actual checkout page URL
}

document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        const ratingValue = star.parentElement.querySelector('.rating-value');
        let rating = parseFloat(ratingValue.textContent);

        const updateStars = (rating) => {
            stars.forEach(s => {
                const starValue = parseInt(s.getAttribute('data-value'));
                if (starValue <= rating) {
                    s.classList.remove('inactive');
                } else {
                    s.classList.add('inactive');
                }
            });
        };

        updateStars(rating);

        star.addEventListener('click', () => {
            rating = parseInt(star.getAttribute('data-value'));
            ratingValue.textContent = rating.toFixed(1);
            updateStars(rating);
        });
    });

    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productPrice = button.getAttribute('data-price');
            const productImg = button.getAttribute('data-img');
            const manufacturingDate = button.getAttribute('data-manufacturing');
            const expiryDate = button.getAttribute('data-expiry');

            const item = {
                id: productId,
                title: productName,
                price: productPrice,
                image: productImg,
                manufacturingDate: manufacturingDate,
                expiryDate: expiryDate,
                quantity: 1
            };

            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingItem = cart.find(item => item.id === productId);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push(item);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        });
    });
});



    function updateCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartMessage = document.getElementById('cartMessage');
    const cartItems = document.getElementById('cartItems');
    const checkoutButton = document.getElementById('checkoutButton');

    if (cart.length === 0) {
        cartMessage.style.display = 'block';
        cartItems.style.display = 'none';
        checkoutButton.style.display = 'none'; // Hide checkout button if cart is empty
    } else {
        cartMessage.style.display = 'none';
        cartItems.style.display = 'block';
        checkoutButton.style.display = 'block'; // Show checkout button if cart has items

        cartItems.innerHTML = '';

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <div class="item-details">
                    <img src="${item.image}" alt="${item.title}">
                    <div>
                        <h4>${item.title}</h4>
                        <p>Price: $${item.price}</p>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                </div>
                <button class="remove-button" data-id="${item.id}">Remove</button>
            `;
            cartItems.appendChild(cartItem);
        });

        // Add event listeners to remove buttons
        const removeButtons = cartItems.querySelectorAll('.remove-button');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = button.getAttribute('data-id');
                removeFromCart(productId);
            });
        });
    }
}

function checkout() {
    // Redirect to checkout page
    window.location.href = 'checkout.php'; // Replace with your actual checkout page URL
}
    </script>
</body>

</html>