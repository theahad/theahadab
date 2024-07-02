<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Right-Side Opening</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <style>


      /* Global styles */
      * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 0;
            padding-top: 70px; /* Add initial padding to avoid overlap with fixed navbar */
            transition: padding-top 0.3s ease; /* Smooth transition for padding change */
            
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
            color: #ff8649;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #911955ef;
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
            background-color: #911955ef;
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
             /* margin-left:350px; */
                text-align:center;
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
        
        

  /* Product card styles */
  .product-card {
    background-color: #911955;
            color: #fff;
            border-radius: 10px;
            overflow: hidden;
            width: 300px; /* Fixed width for each card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            margin: 20px;
            transition: transform 0.3s ease;
            margin-top:40px;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-price {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #e91e63;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .product-image {
            width: 100%;
            height: 200px; /* Fixed height for image */
            object-fit: cover; /* Ensure the image covers the div */
            overflow: hidden; /* Hide any overflow */
            position: relative; /* Needed for overlay */
        }

        .product-image img {
            width: 100%;
            height: 100%; /* Ensure the image covers the entire div */
            transition: transform 0.3s ease; /* Smooth transition for zoom effect */
        }


        .product-image img:hover {
            transform: scale(1.1); /* Zoom effect on hover */
        }

        .product-details {
            padding: 20px;
        }

        .product-details h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
        }

        .product-details p {
            font-size: 0.9em;
            margin: 10px 0;
        }

        .product-details ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .product-details ul li {
            padding-left: 20px;
            margin: 5px 0;
            background: url('checkmark.png') no-repeat left center;
        }

        .product-rating {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .star {
            color: #ffcc00;
            font-size: 1.2em;
            cursor: pointer;
        }

        .star.inactive {
            color: #ccc;
        }

        .add-to-cart {
            background-color: #3F51B5;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .add-to-cart:hover {
            background-color: #d81b60;
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


.star {
    font-size: 20px;
    color: gold;
    cursor: pointer;
    margin: 0 2px;
}

.star.inactive {
    color: #ccc;
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
            <li class="dropdown">
                <a href="#" class="dropbtn">Jewellery</a>
                <div class="dropdown-content">
                <a href="#" class="dropdown-menu__item" data-filter="necklaces">Necklaces</a>
            <a href="#" class="dropdown-menu__item" data-filter="earrings">Earrings</a>
            <a href="#" class="dropdown-menu__item" data-filter="bracelets">Bracelets</a>
            <a href="#" class="dropdown-menu__item" data-filter="rings">Rings</a> <!-- Added Rings -->
                </div>
            </li>
            <li><a href="contact_us.php">Contact</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
      
        <div class="menu-btn" onclick="toggleMenu()">&#9776;</div>
        <div class="shopping-cart" onclick="toggleCart()">
        <!-- Only one shopping cart icon -->
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


    <?php
$servername = "localhost:3309";
$username = "root";
$password = "";
$dbname = "cosmetics_register_db";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$select_query = "SELECT * FROM jewellery";
$result_query = mysqli_query($con, $select_query);


while ($row = mysqli_fetch_assoc($result_query)) {
    $id = $row['id'];
    $name = $row['name'];
    $company_name = $row['company_name'];
    $price = $row['price'];
    $jewellery_img = $row['jewellery_img'];
    $Rating = 4; // Assuming a static rating for now, replace with dynamic value if available

    // Determine category based on your logic
    $category = '';
    if (strpos($name, 'Necklace') !== false) {
        $category = 'necklaces';
    } elseif (strpos($name, 'Earring') !== false) {
        $category = 'earrings';
    } elseif (strpos($name, 'Bracelet') !== false) {
        $category = 'bracelets';
    } elseif (strpos($name, 'Ring') !== false) {
        $category = 'rings';
    }

    echo "<div class=' item' data-category='$category'> <!-- Use col-md-3 to fit 4 cards per row -->
            <div class='product-card'>
                <div class='product-price'>$$price</div>
                <div class='product-image'>
                    <img src='./img/$jewellery_img' class='card-img-top' alt='$name'>
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>$name</h5>
                    <p class='card-text'>ID: $id</p>
                    <p class='card-text'>Price: $price</p>
                    <p class='card-text'>Company: $company_name</p>
                    <div class='product-rating'>
                        <span class='star' data-value='1'>★</span>
                        <span class='star' data-value='2'>★</span>
                        <span class='star' data-value='3'>★</span>
                        <span class='star' data-value='4'>★</span>
                        <span class='star' data-value='5'>★</span>
                        <span class='rating-value'>$Rating</span>
                    </div>
                    <button class='add-to-cart' 
                        data-id='$id' 
                        data-name='$name' 
                        data-price='$price' 
                        data-img='./img/$jewellery_img' 
                        data-company='$company_name'>Add to Cart</button>
                </div>
            </div>
          </div>";
}

echo "</div>"; // End the row

$con->close();
?>




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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        function toggleMenu() {
            const menu = document.querySelector('.nav-links');
            menu.classList.toggle('active');

            // Toggle body class to adjust content margin when menu is active
            document.body.classList.toggle('menu-active');
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
        });
    </script>

    
<script>
  

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



<script>
        document.querySelectorAll('.dropdown-menu__item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');
                document.querySelectorAll('.item').forEach(el => {
                    if (el.getAttribute('data-category') === filter) {
                        el.style.display = 'block';
                    } else {
                        el.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>