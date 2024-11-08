<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fafafa;
        }

        .navbar {
            background-color: #774601;
        }

        .navbar-brand, .nav-link {
            color: white;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #ffcc66;
        }

        .cart-icon {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
            color: white;
        }

        .cart-icon i {
            margin-right: 8px;
        }

        .cart-count {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 0.8rem;
            position: absolute;
            top: -5px;
            right: -10px;
        }

        .cart {
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #774601;
        }

        .product-card {
            border: 1px solid #774601;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-card img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .product-card h2 {
            font-size: 1.5rem;
        }

        .modal .modal-content {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="ms-auto" style="margin-right: 10%;">
                <div class="cart-icon d-flex align-items-center" onclick="openCartModal()">
                    <h4 class="me-2">Cart</h4>
                    <i class="fas fa-shopping-cart fa-2x me-2"></i>
                    <span class="cart-count" id="cart-count">0</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="cart mb-4">
            <h2>Your Cart</h2>
            <p id="cart-total">Total: $0.00</p>
        </div>

        <h1 class="mb-4">Products</h1>
        <div class="row" id="product-list"></div>
    </div>

    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cart-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <h2>Your Cart</h2>
                <ul id="modal-cart-items" class="list-group mb-3"></ul>
                <p id="modal-cart-total" class="mb-4">Total: $0.00</p>
                <button class="btn btn-danger" onclick="closeCartModal()">Close</button>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const products = [
            { id: 1, name: 'Product 1', description: 'Description for product 1', price: 10.00, image: '<?php echo base_url("../assets/product1.jpeg"); ?>' },
            { id: 2, name: 'Product 2', description: 'Description for product 2', price: 20.00, image: '../assets/product2.jpeg' },
            { id: 3, name: 'Product 3', description: 'Description for product 3', price: 15.00, image: '../assets/product3.jpeg' },
        ];

        let cart = [];
        let cartModal;

        document.addEventListener('DOMContentLoaded', function () {
            cartModal = new bootstrap.Modal(document.getElementById('cart-modal'));
            displayProducts();
        });
        function displayProducts() {
            const productList = document.getElementById('product-list');
            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'col-md-3';
                productCard.innerHTML = `
                    <div class="product-card">
                        <img src="${product.image}" alt="${product.name}" class="img-fluid mb-3">
                        <h2>${product.name}</h2>
                        <p>Price: $${product.price.toFixed(2)}</p>
                        <p>${product.description}</p>
                        <button class="btn btn-primary" onclick="addToCart(${product.id})">Add to Cart</button>
                    </div>
                `;
                productList.appendChild(productCard);
            });
        }
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            const cartItem = cart.find(item => item.id === productId);
            
            if (cartItem) {
                cartItem.qty += 1;
            } else {
                cart.push({ ...product, qty: 1 });
            }
            updateCart();
        }


        function updateCart() {
            const cartCount = document.getElementById('cart-count');
            const total = cart.reduce((acc, item) => acc + item.price * item.qty, 0);
            cartCount.textContent = cart.reduce((acc, item) => acc + item.qty, 0);
            document.getElementById('cart-total').textContent = `Total: $${total.toFixed(2)}`;
        }

        function openCartModal() {
            cartModal.show();
            updateModalCart();
        }


        function closeCartModal() {
            cartModal.hide();
        }

        function updateModalCart() {
            const modalCartItems = document.getElementById('modal-cart-items');
            const modalCartTotal = document.getElementById('modal-cart-total');
            modalCartItems.innerHTML = '';

            let total = 0;

            cart.forEach(item => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `
                    ${item.name} - <input type="number" min="1" value="${item.qty}" onchange="updateQuantity(${item.id}, this.value)" style="width: 60px;">
                    <button class="btn btn-danger btn-sm" onclick="removeFromCart(${item.id})">Remove</button>
                `;
                modalCartItems.appendChild(li);
                total += item.price * item.qty;
            });

            modalCartTotal.textContent = `Total: $${total.toFixed(2)}`;
        }

        function updateQuantity(productId, qty) {
            const cartItem = cart.find(item => item.id === productId);
            if (cartItem) {
                cartItem.qty = parseInt(qty);
                updateModalCart();
                updateCart();
            }
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateModalCart();
            updateCart();
        }
    </script>
</body>
</html>
