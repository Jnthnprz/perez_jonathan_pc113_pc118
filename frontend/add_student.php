<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Student</h1>
        <form id="addStudentForm">
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number</label>
                <input type="text" class="form-control" id="contactNumber" name="contactNumber" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Student</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#addStudentForm').on('submit', function (e) {
                e.preventDefault(); 

                const studentData = {
                    l_name: $('#lastName').val(),
                    f_name: $('#firstName').val(),
                    m_name: $('#middleName').val(),
                    age: $('#age').val(),
                    contact_number: $('#contactNumber').val()
                };

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/students', 
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(studentData),
                    success: function (response) {
                        alert('Student added successfully!');
                        window.location.href = 'student.php'; 
                    },
                    error: function (error) {
                        console.error('Error adding student:', error);
                        alert('Failed to add the student. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>