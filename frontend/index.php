<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/welcome-style.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!"><img src="images/jonathan (2).png" style="width: 120px; height: 60px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="" onclick="filterByCategory('')">All Products</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="register.php" onclick="filterByCategory('Animal Medicine')">Animal Medicine</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterByCategory('Pet Toys')">Pet Toys</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterByCategory('Food & Treats')">Food & Treats</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterByCategory('Grooming')">Grooming</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterByCategory('Accessories')">Accessories</a></li>
                        </ul>
                        </li>
                    </ul>
                    <div class="d-flex gap-2" >
                        <button class="btn btn-outline-transparent" type="button" style="background-color: #0292B7; color:white">
                            <i class=" me-1"></i>
                            <a href="register.php" style="text-decoration: none; color: white;">Sign Up</a>
                        </button>
                        <button class="btn btn-outline-tranparent " type="button" style="background-color: #0292B7; color:white">
                            <i class=" me-1"></i>
                            <a href="login.php" style="text-decoration: none; color: white;">Login</a>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Header-->
        <header class="py-2" style="background-color: #0292B7;">
            <div class="container px-4 px-lg-5 ">
                <div class="row align-items-center">
                    <!-- Image on the left -->
                    <div class="col-md-6 text-center">
                        <img src="images/itoy.png" alt="Shop Logo" class="img-fluid" style="max-width: 400px; height: 360px; " />
                    </div>
                    <!-- Text on the right -->
                    <div class="col-md-6 text-white text-md-start text-center">
                        <h1 class="display-4 fw-bolder">Your Pet is Our priority</h1>
                        <p class="lead fw-normal text-white-100 mb-0">Come to our store and buy your Pet needs.</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="product-list">
                    <!-- Products will be dynamically loaded here -->
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5" style="background-color: #0292B7;">
            <div class="container"><p class="m-0 text-center text-white">Pet Store &copy; Kang Majojo ni</p></div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <!-- JavaScript code to filter and display products from the backend API -->
        <script>
            // Function to fetch and display products from API
            async function loadProducts(category = '') {
                try {
                    let url = 'http://localhost:8000/api/products'; // Change this URL to your actual API
                    if (category) {
                        url += `?category=${category}`;
                    }

                    const response = await fetch(url);
                    const products = await response.json();

                    const productList = document.getElementById('product-list');
                    productList.innerHTML = ''; // Clear existing products

                    products.forEach(product => {
                        const productCard = document.createElement('div');
                        productCard.classList.add('col', 'mb-4');
                        productCard.innerHTML = `
                            <div class="card h-100">
                                ${product.on_sale ? '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>' : ''}
                                <img class="card-img-top" src="http://127.0.0.1:8000/storage/${product.image}" alt="${product.name}" />
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">${product.name}</h5>
                                        <p5 class="fw">${product.description}</p5>
                                        <h6 class="fw-bolder">${product.category}</h6>
                                        <span class="text-muted text-decoration-line-through">${product.old_price ? 'Php ' + product.old_price : ''}</span>
                                        Php ${product.price}
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View Options</a></div>
                                </div>
                            </div>
                        `;
                        productList.appendChild(productCard);
                    });
                } catch (error) {
                    console.error('Error loading products:', error);
                }
            }

            // Function to filter products by category
            function filterByCategory(category) {
                loadProducts(category);
            }

            // Load all products by default when page loads
            window.onload = () => loadProducts('');
            
        </script>
    </body>
</html>
