<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier - Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-control {
            border-radius: 5px;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        #productStatus {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cashier - Add Product</h1>

        <!-- Store Reference -->
        <div class="form-group">
            <label for="storeSelect">Select Store</label>
            <select id="storeSelect" class="form-control">
                <option value="store1">Store 1</option>
                <option value="store2">Store 2</option>
                <option value="store3">Store 3</option>
            </select>
        </div>

        <form id="productForm" class="mt-4">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" class="form-control" placeholder="Enter product name" required>
            </div>
            <div class="form-group mt-3">
                <label for="productPrice">Product Price</label>
                <input type="number" id="productPrice" class="form-control" placeholder="Enter product price" required>
            </div>
            <div class="form-group mt-3">
                <label for="productQuantity">Product Quantity</label>
                <input type="number" id="productQuantity" class="form-control" placeholder="Enter product quantity" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Add Product</button>
        </form>
        <div id="productStatus" class="mt-3 text-center"></div>
    </div>

    <script>
        // Handle product form submission
        document.getElementById('productForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const store = document.getElementById('storeSelect').value; // Get selected store
            const productData = {
                store: store, // Include store reference
                name: document.getElementById('productName').value,
                price: document.getElementById('productPrice').value,
                quantity: document.getElementById('productQuantity').value
            };

            try {
                const response = await fetch('http://127.0.0.1:8000/api/products', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(productData)
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('productStatus').innerHTML = `<p class="text-success">Product added successfully for ${store}!</p>`;
                } else {
                    document.getElementById('productStatus').innerHTML = `<p class="text-danger">Failed to add product: ${data.message}</p>`;
                }
            } catch (error) {
                console.error('Error adding product:', error);
                document.getElementById('productStatus').innerHTML = `<p class="text-danger">An error occurred while adding the product.</p>`;
            }
        });
    </script>
</body>
</html>