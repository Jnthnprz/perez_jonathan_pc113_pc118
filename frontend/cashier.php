<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Point of Sale</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <style>
    body {
      background-color: rgb(91, 202, 180);
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
    #cartTable th, #cartTable td {
      vertical-align: middle;
    }

    @media print {
      body * {
        visibility: hidden;
      }
      #printSection, #printSection * {
        visibility: visible;
      }
      #printSection {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div style="background-color: white; margin: 15px; padding: 20px 0; border-radius: 10px;">
    <div class="container mt-4" style="width: 1000px;">
      <h1 class="text-center">Point of Sale</h1>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <!-- Left Side: Product Form -->
      <div class="col-md-7">
        <div class="position-sticky" style="top: 30px;">
          <div class="bg-white rounded shadow p-4">
            <form id="addProductForm">
              <div class="form-group">
                <label for="productCode">Product Code</label>
                <input type="text" id="productCode" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="productPrice">Product Price</label>
                <input type="number" id="productPrice" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="productQuantity">Product Quantity</label>
                <input type="number" id="productQuantity" class="form-control" required />
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-3" style="background-color: #0292B7;">
                Add to Cart
              </button>
            </form>
          </div>
        </div>
        <div class="back">
          <a href="dashboard.php" class="btn mt-3" style="background-color:#0292B7; color:white">Back</a>
        </div>
      </div>

      <!-- Right Side: Cart -->
      <div class="col-md-5">
        <div class="bg-white rounded shadow p-4 mb-5">
          <h2 class="text-center mb-4">Cart</h2>
          <table class="table table-bordered" id="cartTable">
            <thead class="thead-dark">
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>₱</th>
                <th>Qty</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

          <div class="text-right">
            <h4>Total: ₱<span id="totalPrice">0.00</span></h4>
          </div>

          <button id="processSale" class="btn btn-block mt-4" style="background-color: #0292B7; color:white">Process Sale</button>
          <div id="saleStatus" class="mt-3 text-center"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Sale Summary -->
  <div class="modal fade" id="saleModal" tabindex="-1" role="dialog" aria-labelledby="saleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content p-4">
        <div class="modal-header">
          <h5 class="modal-title" id="saleModalLabel">Sale Summary</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="printSection">
          <h4>Purchased Items:</h4>
          <div id="saleSummaryText" style="font-family: monospace; white-space: pre-wrap;"></div>
          <h5 class="text-right">Total Amount: ₱<span id="modalTotal">0.00</span></h5>
        </div>
        <div class="modal-footer">
          <button onclick="window.print()" class="btn btn-info">🖨️ Print</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let cart = [];

    document.getElementById('addProductForm').addEventListener('submit', function (event) {
      event.preventDefault();

      const productCode = document.getElementById('productCode').value;
      const name = document.getElementById('productName').value;
      const price = parseFloat(document.getElementById('productPrice').value);
      const quantity = parseInt(document.getElementById('productQuantity').value);

      if (!productCode || !name || isNaN(price) || isNaN(quantity) || quantity <= 0 || price <= 0) {
        alert('Please enter valid product details.');
        return;
      }

      const product = {
        code: productCode,
        name,
        price,
        quantity,
        total: price * quantity
      };
      cart.push(product);

      updateCart();
      this.reset();
    });

    function updateCart() {
      const cartTableBody = document.querySelector('#cartTable tbody');
      cartTableBody.innerHTML = '';

      let totalPrice = 0;

      cart.forEach((product, index) => {
        totalPrice += product.total;

        const row = `
          <tr>
            <td>${product.code}</td>
            <td>${product.name}</td>
            <td>₱${product.price.toFixed(2)}</td>
            <td>${product.quantity}</td>
            <td>₱${product.total.toFixed(2)}</td>
            <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remove</button></td>
          </tr>
        `;
        cartTableBody.innerHTML += row;
      });

      document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
    }

    function removeFromCart(index) {
      cart.splice(index, 1);
      updateCart();
    }

    document.getElementById('processSale').addEventListener('click', function () {
      if (cart.length === 0) {
        alert('Cart is empty. Please add products to the cart.');
        return;
      }

      let receipt = '';
      let total = 0;

      cart.forEach((product, i) => {
        receipt += `Item ${i + 1}\n`;
        receipt += `Code     : ${product.code}\n`;
        receipt += `Name     : ${product.name}\n`;
        receipt += `Price    : ₱${product.price.toFixed(2)}\n`;
        receipt += `Quantity : ${product.quantity}\n`;
        receipt += `Subtotal : ₱${product.total.toFixed(2)}\n`;
        receipt += `--------------------------\n`;
        total += product.total;
      });

      document.getElementById('saleSummaryText').textContent = receipt;
      document.getElementById('modalTotal').textContent = total.toFixed(2);

      $('#saleModal').modal('show');
    });
  </script>
</body>
</html>
