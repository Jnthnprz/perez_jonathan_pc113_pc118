<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Table</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
        .container {
            margin-left: 280px;
        }
        .cont1 {
            margin-top: 70px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="container">
        <div class="cont1">
        <div class="add">
                <a href="add_student.php" class="btn btn-primary">Add Employee</a>
            </div>
            <h1>Student Data Table</h1>
            <table id="studentTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Age</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="back">
                <a href="dashboard.php" class="back-button">Back</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch students data
            $.ajax({
                url: 'http://127.0.0.1:8000/api/students', 
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log('Data fetched successfully:', data); 
                    let tableBody = '';
                    data.forEach((student) => {
                        tableBody += `
                            <tr>
                                <td>${student.id}</td>
                                <td>${student.l_name}</td>
                                <td>${student.f_name}</td>
                                <td>${student.m_name}</td>
                                <td>${student.age}</td>
                                <td>${student.contact_number}</td>
                                <td>
                                    <a href="edit-student.php?id=${student.id}" class="btn btn-primary btn-sm">Edit</a>
                                    <button class="delete-btn btn btn-danger btn-sm" data-id="${student.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#studentTable tbody').html(tableBody);

                    // Initialize DataTable
                    $('#studentTable').DataTable({
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

                    // Add event listener for delete buttons
                    $('.delete-btn').on('click', function () {
                        const studentId = $(this).data('id');
                        if (confirm('Are you sure you want to delete this student?')) {
                            $.ajax({
                                url: `http://127.0.0.1:8000/api/students/${studentId}`,
                                method: 'DELETE',
                                success: function (response) {
                                    alert('Student deleted successfully!');
                                    location.reload(); 
                                },
                                error: function (error) {
                                    console.error('Error deleting student:', error);
                                    alert('Failed to delete the student. Please try again.');
                                }
                            });
                        }
                    });
                },
                error: function (error) {
                    console.error('Error fetching students:', error);
                }
            });
        });
    </script>
</body>
</html>