<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM admin2 WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        header('location:index.php');
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/AGCOWC PROJECTJS/pictures/agcowc logo_1.png">
    <link rel ="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Home</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">

<div class="container">
	<a class="navbar-brand" href="index.html"><Span class="text-warning"><img src="pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
		data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" onclick="scrollToSection('home')" style="cursor:pointer">Home</a>
			</li>
			<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="profile_admin.php">View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="feedbacks.php">Feedbacks</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="manage.php">Manage Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="bible.php">Bible</a>
            </li>
			<li class="nav-item" id="applog">
				<a class="nav-link active" aria-current="page" @click="confirmLogout" style="cursor:pointer">Log-out</a>
			</li>
		</ul>

	</div>
</div>
</nav>	
<div class="container">
    <div class="row">
        <div class="col-3 my-5">
            <img src="./pictures/agcow logo.png" class="img" alt="agcowc">
                <style>
                    .img 
                    {
                         height: 15vh;
                         background-repeat: no-repeat;
                         background-size: cover;
                         width: 150px;
                    }
                </style>
                <br>
                <?php echo $row['admin_fname']. "  " . $row['admin_lname'];?>
        </div>
        <div class="col py-4">
            <div class="card px-4 py-4 mx-2">
                <form action="post.php" method="POST">
                    <div class="form-group">
                        <label>POST ANNOUNCEMENT</label>
                        <input type="text" class="form-control my-2" name="title" placeholder="Write Title">
                            <div id="app">
                                <textarea class="form-control my-2" name="post" placeholder="Write Announcement:" style="transition: height 0.3s;"  v-bind:style="{ height: textareaHeight + 'px' }" v-on:click="expandTextarea" required></textarea>
                            </div>
                            <input type="hidden" class="form-control my-2" name="id" placeholder="Name" value="<?php echo $row['id'];?>">
                        <input type="hidden" class="form-control my-2" name="author" placeholder="Name" value="<?php echo $row['admin_fname']. "  " . $row['admin_lname'];?>">
                    </div>
                    <label for=checkbox>Post To </label>
                    <br>
                    <input type="checkbox" name="option[]" value="public" > Public
                    <input type="checkbox" name="option[]" value="private"> Private
                </br>
                    <button type="submit" name="create_post" class="btn btn-primary" value="POST">Add post</button>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

<!-- <script>
    function confirmLogout() {
        Swal.fire({
            title: 'Logout',
            text: 'Are you sure you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log me out!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php"; // Redirect to logout page if confirmed
            }
        });
    }
</script> -->
        <?php 
		    require 'dbcon.php'; 
		    $sql = $conn->prepare ("SELECT  * FROM post INNER JOIN admin2 ON post.id = admin2.id");
		    $sql->execute();        
	    ?>
        <?php 
		    while ($row = $sql->fetch()) {
            $postDate = date("F j, Y", strtotime($row['post_date']));
	    ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-3"></div>
                <div class="col-sm-10 col-md-10 col-lg-6">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: 016A70;"> <img src="./pictures/agcow logo.png" class="img1" alt="agcowc">
                            <style>
                                .img1 
                                    {
                                        height: 7vh;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        width: 70px;
                                    }
                            </style>
                       <?php echo $postDate; ?>
                        </h5>
                         <div class="card-body bg-muted">
                            <h5 class="card-title"><?php echo $row['user_title'] ;?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['user_post']); ?></p>
                                <p class="card-text">BY: <?php echo $row['admin_fname']. " " .$row['admin_lname'];?></p>
                                <form action="post_edit_query.php" method="POST" style="display: inline;">
                                    <button type="submit" name="edit" class="btn btn-success mr-2" value="<?php echo $row['post_id']; ?>">Edit</a>
                                </form>
                                <div class="div">
                                <button onclick="confirmDelete('<?php echo $row['post_id']; ?>')" class="btn btn-warning ml-2" style="margin-left: 10px;">Delete</button>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="col col-xs-2 col-sm-10 col-md-11 col-lg-11"></div>
                </div>
            <br>
            <?php } ?>

<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete_post.php?post_id=' + postId;
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
<script src="/AGCOWC PROJECTJS/vueframework/home.js"></script>
<script src="/AGCOWC PROJECTJS/vueframework/apptext.js"></script>

</body>
</html>