<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .container {
        margin-left: 280px;
        padding: 20px;
    }
    .anak {
        border-radius: 8px;
        padding: 10px;
    }
    .cont1 {
        margin-top: 70px;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .userinfo {
        background-color: white;
        display: flex;
        padding: 5px;
        font-size: 40px;
        border-bottom: 3px solid black;
    }
    .information {
        margin-top: 10px;
        background-color: white;
        display: flex;
        font-size: 20px;
        border-bottom: 3px solid black;
    }
    .fileupload {
        margin-top: 10px;
        background-color: white;
        display: block;
        font-size: 20px;
        border-bottom: 3px solid black; 
    }
</style>
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
        <div class="container1">
            <div class="anak">
                <div class="userinfo" id="userinfo">
                    <!-- User's name will be dynamically loaded here -->
                </div>
                <div class="information" id="information">
                    <!-- User's additional information will be dynamically loaded here -->
                </div>
                <div class="fileupload">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <input type="file" name="document" id="document" class="form-control mb-3" accept=".pdf,.doc,.docx">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                    <div id="uploadStatus" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fetch user information from the backend
        fetch('http://127.0.0.1:8000/api/view', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('userinfo').innerHTML = `Logged in as: ${data.name}`;
            document.getElementById('information').innerHTML = `
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Role:</strong> ${data.role || 'N/A'}</p>
            `;
        })
        .catch(error => {
            console.error('Error fetching user:', error);
            alert('An error occurred while fetching user information. Please try again.');
        });

        // Handle file upload
        document.getElementById('uploadForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const formData = new FormData();
            const fileInput = document.getElementById('document');
            formData.append('document', fileInput.files[0]);

            try {
                const response = await fetch('http://127.0.0.1:8000/api/upload-document', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    const fileUrl = data.file_url || '#';
                    const fileName = fileInput.files[0].name;

                    document.getElementById('uploadStatus').innerHTML = `
                        <p class="text-success">File uploaded successfully!</p>
                        <p><strong>Uploaded File:</strong> 
                            <a href="${fileUrl}" target="_blank">${fileName}</a>
                        </p>
                    `;
                } else {
                    document.getElementById('uploadStatus').innerHTML = `<p class="text-danger">Failed to upload file: ${data.message}</p>`;
                }
            } catch (error) {
                console.error('Error uploading file:', error);
                document.getElementById('uploadStatus').innerHTML = `<p class="text-danger">An error occurred while uploading the file.</p>`;
            }
        });
    </script> 
</body>
</html>
