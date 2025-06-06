<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Data Table</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 0;
      margin: 0;
      display: inline-block;
      border: 1px solid transparent;
      border-radius: 0.25rem;
      background: rgb(50, 63, 60);
      color: #ffffff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: #007b5e;
      color: #ffffff !important;
    }
    .back a {
      background: rgb(39, 56, 52);
      display: inline-block;
      color: #ffffff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
    .back a:hover {
      background: #007b5e;
    }
    /* .container {
      margin-left: 280px;
    } */
    .cont1 {
      margin-top: 20px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  
  <?php include 'sidebar.php'; ?>
    <div class="container">
      <div class="d-flex justify-content-end" style="width: 100%; line-height: 30px; padding: 15px;">
        <div class="dropdown">
          <button class="btn btn-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
           Profile ni
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </div>
    </div>

    <div class="cont1">
      <div class="add mb-1">
        <a href="add_employee.php" class="btn btn-primary">Add Employee</a>
      </div>
      <h1>Employee Data Table</h1>
      <table id="employeeTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Contact Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <div class="back">
        <a href="dashboard.php" class="back-button">Back</a>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editEmployeeForm">
            <input type="hidden" id="editEmployeeId">
            <div class="form-group">
              <label for="editLastName">Last Name</label>
              <input type="text" class="form-control" id="editLastName" required>
            </div>
            <div class="form-group">
              <label for="editFirstName">First Name</label>
              <input type="text" class="form-control" id="editFirstName" required>
            </div>
            <div class="form-group">
              <label for="editMiddleName">Middle Name</label>
              <input type="text" class="form-control" id="editMiddleName">
            </div>
            <div class="form-group">
              <label for="editMiddleName">Email</label>
              <input type="text" class="form-control" id="editMiddleName">
            </div>
            <div class="form-group">
              <label for="editAge">Age</label>
              <input type="number" class="form-control" id="editAge" required>
            </div>
            <div class="form-group">
              <label for="editContactNumber">Contact Number</label>
              <input type="text" class="form-control" id="editContactNumber" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $.ajax({
        url: 'http://127.0.0.1:8000/api/employees',
        method: 'GET',
        success: function (data) {
          let tableBody = '';
          data.forEach((employee) => {
            tableBody += `
              <tr>
                <td>${employee.id}</td>
                <td>${employee.l_name}</td>
                <td>${employee.f_name}</td>
                <td>${employee.m_name}</td>
                <td>${employee.email}</td>
                <td>${employee.age}</td>
                <td>${employee.contact_number}</td>
                <td>
                  <button class="edit-btn btn btn-primary btn-sm" data-id="${employee.id}">Edit</button>
                  <button class="delete-btn btn btn-danger btn-sm" data-id="${employee.id}">Delete</button>
                </td>
              </tr>`;
          });
          $('#employeeTable tbody').html(tableBody);

        
          $('#employeeTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            language: {
              search: "Search:",
              lengthMenu: "Show _MENU_ entries",
              info: "Showing _START_ to _END_ of _TOTAL_ entries",
            }
          });
        },
        error: function (error) {
          console.error('Error fetching employees:', error);
          alert('Failed to fetch employees. Please try again.');
        }
      });

      $(document).on('click', '.edit-btn', function () {
        const employeeId = $(this).data('id');
        if (!employeeId) {
          alert('Invalid employee ID.');
          return;
        }

        $.ajax({
          url: `http://127.0.0.1:8000/api/employees/${employeeId}`,
          method: 'GET',
          success: function (employee) {
            $('#editEmployeeId').val(employee.id);
            $('#editLastName').val(employee.l_name);
            $('#editFirstName').val(employee.f_name);
            $('#editMiddleName').val(employee.m_name);
            $('#editMiddleName').val(employee.email);
            $('#editAge').val(employee.age);
            $('#editContactNumber').val(employee.contact_number);
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
          },
          error: function (error) {
            console.error('Error fetching employee details:', error);
            if (error.status === 404) {
              alert('Employee not found.');
            } else {
              alert('Server error. Please try again later.');
            }
          }
        });
      });

      $('#editEmployeeForm').on('submit', function (e) {
        e.preventDefault();
        const employeeId = $('#editEmployeeId').val();
        const updatedData = {
          l_name: $('#editLastName').val(),
          f_name: $('#editFirstName').val(),
          m_name: $('#editMiddleName').val(),
          email: $('#editMiddleName').val(),
          age: $('#editAge').val(),
          contact_number: $('#editContactNumber').val()
        };

        $.ajax({
          url: `http://127.0.0.1:8000/api/employees/${employeeId}`,
          method: 'PUT',
          contentType: 'application/json',
          data: JSON.stringify(updatedData),
          success: function () {
            alert('Employee updated successfully!');
            $('#editModal').modal('hide');
            location.reload();
          },
          error: function (error) {
            console.error('Error updating employee:', error);
            alert('Failed to update the employee. Please try again.');
          }
        });
      });

      $(document).on('click', '.delete-btn', function () {
        const employeeId = $(this).data('id');
        if (confirm('Are you sure you want to delete this employee?')) {
          $.ajax({
            url: `http://127.0.0.1:8000/api/employees/${employeeId}`,
            method: 'DELETE',
            success: function () {
              alert('Employee deleted successfully!');
              location.reload();
            },
            error: function (error) {
              console.error('Error deleting employee:', error);
              alert('Failed to delete the employee. Please try again.');
            }
          });
        }
      });
    });
  </script>
</body>
</html>
