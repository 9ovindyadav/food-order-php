<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/bootstrap-4.6.2/css/bootstrap.css">
	<script defer src="../css/bootstrap-4.6.2/js/bootstrap.bundle.js"></script>

    <link rel="stylesheet" href="../css/admin.css">
    <script defer src="../js/admin.js"></script>
</head>


<header>

<div class="logosec">
<img src="../images/icons/menu.svg"
        class="icn menuicn"
        id="menuicn"
        alt="menu-icon">
<div class="logo">SK Chinese</div>
    
</div>


<div class="message">
    <div class="circle"></div>
    <img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png"
        class="icn"
        alt="">
    <div class="dp">
    <img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
            class="dpicn"
            alt="dp">
    </div>
</div>

</header>

<div class="main-container">
<div class="navcontainer">
    <nav class="nav">
        <div class="nav-upper-options">
            
                <a href="/admin/dashboard" class="nav-option option2">
                    <img src="../images/icons/dashboard.svg"
                        class="nav-img"
                        alt="dashboard">
                    <h3> Dashboard</h3>
                </a>
        

            
                <a href="/admin/orders" class="option2 nav-option">
                    <img src="../images/icons/orders.svg"
                        class="nav-img"
                        alt="articles">
                    <h3> Orders</h3>
                </a>
        

            
                <a href="/admin/users" class="nav-option option3">
                    <img src="../images/icons/users.svg"
                        class="nav-img"
                        alt="report">
                    <h3> Users</h3>
                </a>

            <a href="/admin/menu" class="nav-option option5">
                    <img src="../images/icons/dishes.svg"
                        class="nav-img"
                        alt="blog">
                    <h3> Menu </h3>
            </a>

            <a href="/user/profile" class="nav-option option6">
                <img src="../images/icons/settings.svg"
                    class="nav-img"
                    alt="settings">
                <h3> Profile</h3>
            </a>

            <a href="/logout" class="nav-option logout">
                <img src="../images/icons/log-out.svg"
                    class="nav-img"
                    alt="logout">
                <h3>Logout</h3>
            </a>

        </div>
    </nav>
</div>