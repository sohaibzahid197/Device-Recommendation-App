<?php
if (!isset($basePath)) {
    $basePath = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Recommendation Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!--     <link rel="stylesheet" href="css/styles.css"> -->
    <style>
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-size: 18px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa; 
        }

        .navbar-toggler {
            border-color: #fff; 
        }

        .navbar-toggler-icon {
            background-color: #5D6D7E; 
        }

        .logout-btn {
/*             background-color: green; */
            border: 2px solid #fff;
            color: #red;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-btn:hover {
            background-color: #red;
            color: #red; 
        }
.footer {
    background-color: #2a2a2a; 
    color: #f0f0f0;
    padding: 20px;
    font-size: 14px;
}

.footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.footer span {
    flex: 1;
    text-align: left;
}

.footer a {
    color: #f0f0f0;
    text-decoration: none;
    padding: 5px;
    transition: color 0.3s ease-in-out;
}

.footer a:hover {
    color: #007bff;
    text-decoration: underline;
}

/* Enhance readability and spacing for smaller screens */
@media (max-width: 576px) {
    .footer {
        text-align: center;
    }

    .footer .container {
        flex-direction: column;
    }

    .footer span,
    .footer a {
        display: block;
        margin: 5px 0;
    }
}
        
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<a class="navbar-brand" href="/My%20Web%20Assignment/device.php">Device Recommendations</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>../device.php">Devices Selections</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>os_overview.php">OS Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>ranking.php">View Device Rankings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>give_review.php">Give Review</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo $basePath; ?>my_reviews.php">My Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link logout-btn" href="<?php echo $basePath; ?>logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
</body>
</html>
