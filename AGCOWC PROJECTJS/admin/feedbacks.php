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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" href="/AGCOWC PROJECTJS/pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Feedbacks</title>
</head>

<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">

        <div class="container">
            <a class="navbar-brand" href="index.html"><Span class="text-warning"><img src="pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="success.php">Home</a>
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
    <div class="container mt-5">
    <div class="row mb-3">
    <div class="col-lg-6 offset-lg-3">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        ?>
        <form method="GET" action="" autocomplete="off">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by email or post" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<?php
require 'dbcon.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $sql = $conn->prepare("SELECT * FROM feedback INNER JOIN users ON feedback.user_id = users.user_id WHERE user_email LIKE :search OR user_feedback LIKE :search OR user_fname LIKE :search");
    $sql->bindValue(':search', '%' . $search . '%');
} else {
    $sql = $conn->prepare("SELECT  * FROM feedback INNER JOIN users ON feedback.user_id = users.user_id");
}

        $sql->execute();

        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch()) {
                ?>
                <div class="row">
                    <div class="col-sm-1 col-md-1 col-lg-3"></div>
                    <div class="col-sm-10 col-md-10 col-lg-6">
                        <div class="card">
                            <!-- <h5 class="card-header bg-primary"><img src="./pictures/agcow logo.png" class="img1" alt="agcowc">
                                <style>
                                    .img1 {
                                        height: 7vh;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        width: 70px;
                                    }
                                </style>
                                Feedbacks</h5> -->
                            <div class="card-body bg-muted">
                                <h5 class="card-title"><img src="upload/<?php echo $row["profile_photo"]?>" class="img- rounded-circle" width="50px" height="50px" alt="agcowc"><?php echo " ". $row['user_fname']. " " . $row['user_lname']; ?></h5>
                                <p class="card-text"><?php echo $row['user_feedback']; ?></p>
                                <p class="card-text">BY: <?php echo $row['user_email']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-3"></div>
                </div>
                <br>
            <?php
        }
    } else {
        echo "<h5 class='text-center my-5'>No Results</h5>";
    }
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
</body>

</html>
