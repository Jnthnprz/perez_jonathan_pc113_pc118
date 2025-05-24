<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/dropify.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/dropify.min.css">

    <style>
        body {
            background-color: #f1f3f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 100px;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 40px;
        }

        .product-card {
            border: none;
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }

        .product-card .card-body {
            padding: 20px;
        }

        .price-tag {
            font-weight: 600;
            color: #28a745;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:rgb(5, 110, 136);">
        <a class="navbar-brand" href="dashboard.php"><img src="images/logo.png" alt="" style="width: 100px; height:80px; margin:0px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">
        <h1 class="text-center section-title"> Our Products</h1>

        <!-- Category Filter and Add Button -->
        <div class="d-flex justify-content-between align-items-center mb-4" style=" border-bottom: 3px solid black; padding-bottom: 20px;">
            <select id="categoryFilter" class="form-control w-25">
                <option value="">All Categories</option>
                <option value="Pet Toys">Pet Toys</option>
                <option value="Animal Medicine">Animal Medicine</option>
                <option value="Pet Food">Pet Food</option>
                <option value="Accessories">Accessories</option>
                <option value="Grooming Supplies">Grooming Supplies</option>
                <option value="Habitat Essentials">Habitat Essentials</option>
            </select>
            <button class="btn" data-toggle="modal" data-target="#productModal" onclick="resetForm()" style="background-color: rgb(5, 110, 136); color:white;">Add Product</button>
        </div>

        <div id="productList" class="row"></div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="productForm" enctype="multipart/form-data">
                <input type="hidden" name="id" id="productId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Form</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Name" required>
                        <textarea name="description" id="description" class="form-control mb-2" placeholder="Description"></textarea>
                        <input type="number" name="price" id="price" class="form-control mb-2" placeholder="Price" required>
                        <input type="number" name="quantity" id="quantity" class="form-control mb-2" placeholder="Stock" required>
                        <select name="category" id="category" class="form-control mb-2" required>
                            <option value="">All Categories</option>
                            <option value="Pet Toys">Pet Toys</option>
                            <option value="Animal Medicine">Animal Medicine</option>
                            <option value="Pet Food">Pet Food</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Grooming Supplies">Grooming Supplies</option>
                            <option value="Habitat Essentials">Habitat Essentials</option>
                        </select>
                        <input type="file" name="image" id="image" class="form-control dropify" data-allowed-file-extensions="jpg png jpeg webp">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="confirmCancel()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JS dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://127.0.0.1:8000/dist/js/dropify.js"></script>
    <script src="http://127.0.0.1:8000/dist/js/dropify.min.js"></script>


   <script>
    const apiUrl = 'http://127.0.0.1:8000/api/products';

    $(document).ready(function () {
        loadProducts();

        // Initialize Dropify globally
        $('.dropify').dropify();

        $('#productForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#productId').val();
            let url = id ? `${apiUrl}/${id}` : apiUrl;

            if (id) {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function () {
                    $('#productModal').modal('hide');
                    loadProducts();
                    resetForm();
                    Swal.fire('Saved!', 'Product has been saved successfully.', 'success');
                },
                error: function (err) {
                    console.error(err.responseJSON);
                    Swal.fire('Error', 'Failed to save product.', 'error');
                }
            });
        });

        $('#categoryFilter').on('change', loadProducts);
    });

    function loadProducts() {
        const selectedCategory = $('#categoryFilter').val();

        $.ajax({
            url: apiUrl,
            method: 'GET',
            success: function (data) {
                const productList = $('#productList');
                productList.empty();

                const filtered = selectedCategory ? data.filter(p => p.category === selectedCategory) : data;

                filtered.forEach(product => {
                    const productCard = `
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card product-card">
                                <img src="http://127.0.0.1:8000/storage/${product.image}" class="card-img-top" alt="${product.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text">${product.description}</p>
                                    <p class="card-text price-tag">₱${parseFloat(product.price).toFixed(2)}</p>
                                    <p class="card-text"><small class="text-muted">${product.category}</small></p>
                                    <p class="card-text"><small class="text-muted">Stock: ${product.quantity}</small></p>
                                    <button class="btn btn-sm btn-info" onclick="editProduct(${product.id})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">Delete</button>
                                </div>
                            </div>
                        </div>
                    `;
                    productList.append(productCard);
                });
            },
            error: function () {
                $('#productList').html(`<div class="col-12 text-center text-danger"><p>Failed to load products.</p></div>`);
            }
        });
    }

    function resetForm() {
        $('#productForm')[0].reset();
        $('#productId').val('');

        // Reset Dropify
        const drEvent = $('#image').data('dropify');
        if (drEvent) {
            drEvent.resetPreview();
            drEvent.clearElement();
        }
    }

    function editProduct(id) {
        $.get(`${apiUrl}/${id}`, function (product) {
            $('#productId').val(product.id);
            $('#name').val(product.name);
            $('#description').val(product.description);
            $('#price').val(product.price);
            $('#quantity').val(product.quantity);
            $('#category').val(product.category);

            // Update Dropify with existing image
            let imageInput = $('#image');
            imageInput.attr('data-default-file', `http://127.0.0.1:8000/storage/${product.image}`);

            // Destroy and reinit Dropify
            let drEvent = imageInput.data('dropify');
            if (drEvent) {
                drEvent.destroy();
            }

            // Reinit with default file
            imageInput.dropify({
                defaultFile: `http://127.0.0.1:8000/storage/${product.image}`
            });

            $('#productModal').modal('show');
        });
    }

    function deleteProduct(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `${apiUrl}/${id}`,
                    method: 'POST',
                    data: { _method: 'DELETE' },
                    success: function () {
                        Swal.fire('Deleted!', 'The product has been deleted.', 'success');
                        loadProducts();
                    },
                    error: function () {
                        Swal.fire('Failed!', 'There was an error deleting the product.', 'error');
                    }
                });
            }
        });
    }

    function confirmCancel() {
        Swal.fire({
            title: 'Discard changes?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#productModal').modal('hide');
                resetForm();
            }
        });
    }
</script>
</body>
</html>
