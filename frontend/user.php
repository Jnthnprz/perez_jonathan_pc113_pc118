<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Data Table</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        .container {
            margin-left: 280px; /* Keeps it to the right of the sidebar */
            padding-right: 20px;
            width: calc(100% - 280px); /* Occupy all available space */
        }

       .container-fluid-main {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 20px;
        }

        .cont1 {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .table-responsive {
            overflow-x: auto;
        }

    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
   <div class="container-fluid px-3">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid-main">
    <div class="cont1">
        <div class="add mb-3">
            <a href="add_user.php" class="btn btn-primary">Add User</a>
        </div>
        <h1>User Data Table</h1>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
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
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId" />
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" required />
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" required />
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" required>
                                <option value="1">Admin</option>
                                <option value="3">Cashier</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
    function getRoleName(role) {
        switch (parseInt(role)) {
            case 1: return 'Admin';
            case 3: return 'Cashier';
            case 2: return 'Customer';
            default: return 'Unknown';
        }
    }

    function loadUsers() {
        fetch('http://127.0.0.1:8000/api/users', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(res => res.json())
        .then(data => {
            let tableBody = '';
            data.forEach(user => {
                tableBody += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${getRoleName(user.role)}</td>
                        <td>
                            <button class="edit-btn btn btn-primary btn-sm" data-id="${user.id}">Edit</button>
                            <button class="delete-btn btn btn-danger btn-sm" data-id="${user.id}">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $('#userTable tbody').html(tableBody);

            if (!$.fn.DataTable.isDataTable('#userTable')) {
                $('#userTable').DataTable({
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
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
            Swal.fire('Error', 'Failed to load users.', 'error');
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        loadUsers();

        // Edit button
        document.body.addEventListener('click', function (e) {
            if (e.target.classList.contains('edit-btn')) {
                const userId = e.target.getAttribute('data-id');

                fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then(res => res.json())
                .then(user => {
                    document.getElementById('editUserId').value = user.id;
                    document.getElementById('editName').value = user.name;
                    document.getElementById('editEmail').value = user.email;
                    document.getElementById('editRole').value = user.role;

                    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                })
                .catch(() => {
                    Swal.fire('Error', 'Failed to fetch user details.', 'error');
                });
            }
        });

        // Submit Edit Form
        document.getElementById('editUserForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const userId = document.getElementById('editUserId').value;
            const updatedData = {
                name: document.getElementById('editName').value,
                email: document.getElementById('editEmail').value,
                role: document.getElementById('editRole').value
            };

            fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify(updatedData)
            })
            .then(res => {
                if (!res.ok) throw new Error();
                return res.json();
            })
            .then(() => {
                Swal.fire('Success', 'User updated successfully!', 'success').then(() => {
                    const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                    editModal.hide();
                    loadUsers();
                });
            })
            .catch(() => {
                Swal.fire('Error', 'Failed to update user.', 'error');
            });
        });

        // Delete user
        document.body.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-btn')) {
                const userId = e.target.getAttribute('data-id');

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
                        fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw new Error();
                            return res.json();
                        })
                        .then(() => {
                            Swal.fire('Deleted!', 'User has been deleted.', 'success').then(() => {
                                loadUsers();
                            });
                        })
                        .catch(() => {
                            Swal.fire('Error', 'Failed to delete the user.', 'error');
                        });
                    }
                });
            }
        });
    });
</script>

</body>
</html>
