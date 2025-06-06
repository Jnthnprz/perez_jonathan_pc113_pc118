<?php

session_start();
// if (!isset($_SESSION['token'])) {
//     header("Location: index.php");
//     exit();
// }

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
     body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 280px;
            height: 100vh;
            padding-top: 10px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar2 {
            overflow-y: auto;
            color: #0292B7;
            align-items: center;
            padding: 5px 10px;
            text-align: center;
            font-size: 18px;
        }
        .sidebar2 button{
            margin-top: 15px;
            margin-right: 100px;
            display: flex;
            align-items: center;
            color:rgb(5, 110, 136);
            padding: 5px 10px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar a {
            margin-top: 15px;
            display: flex;
            align-items: center;
            color:rgb(5, 110, 136);
            padding: 5px 10px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar a svg {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color:rgb(6, 65, 124);
            color: #ecdbff;
        }
        .sidebar a.active {
            background-color: #1abc9c;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .cashier{
            display: flex;
            align-items: center;
            color:rgb(5, 110, 136);
            padding: 5px 20px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
            /* border-bottom: 3px solid rgb(5, 110, 136); */
        }
        .cashier2{
            overflow-y: auto;
            color: #0292B7;
            align-items: center;
            padding: 0 0;
            text-align: center;
            font-size: 18px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
        .cashier2 a{
            display: flex;
            align-items: center;
            color:rgb(5, 110, 136);
            padding: 5px 20px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
</style>
<body>  
<div class="sidebar">
        <div class="sidebar2">
            <img src="images/jonathan.png" alt="Logo" style="width: 180px; height: 90px;">
        <a href="profile.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"/><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"/></svg>
            Profile
        </a>
        <a href="dashboard.php">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M13.45 11.55l2.05 -2.05" /><path d="M6.4 20a9 9 0 1 1 11.2 0z" /></svg>         
            Dashboard
        </a>
        <!-- <p class="d-inline-flex gap-1 "> -->
           <!-- <button class="btn btn-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color:rgb(5, 110, 136); background:transparent; font-size:18px;  "> -->
               
        <!-- <?php
        // if (isset($_SESSION['role']) && $_SESSION['role'] == 0){
            
            // User is an admin
        // ?> -->
         <a id="userLink" href="user.php">
               <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
               stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-square">
               <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 10a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M6 21v-1a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v1" />
               <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /></svg></i>
           Manage Users
               </a>
        <?php
        // }
        ?>

           <!-- </button>
           </p> -->
           <!-- <div class="collapse" id="collapseExample">
           <div class="card-body-transparent" style="background:gray; font:white ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                    Users</a>       
                <a class="dropdown-item" href="employees.php" style="color:white;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                Employees</a>
            </div>
           </div> -->
           <a id = "userproducts" href="products.php">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-producthunt"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 16v-8h2.5a2.5 2.5 0 1 1 0 5h-2.5" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /></svg>
            Manage Products
        </a>
        </div>
        
    <!-- <div class="cashier">
    </div> -->
    
    <div class="cashier2">
         <a href="cashier.php">
         <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-imac"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-12z" /><path d="M3 13h18" /><path d="M8 21h8" /><path d="M10 17l-.5 4" /><path d="M14 17l.5 4" /></svg>            
         Cashier
        </a>


    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch ('http://127.0.0.1:8000/api/user', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.role != 1) {
                    document.getElementById('userLink').style.display = 'none';
                    document.getElementById('userproducts').style.display = 'none';
                    
                }
            })
        });
    </script>
</body>
</html>


