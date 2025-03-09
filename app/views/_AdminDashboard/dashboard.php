<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app/views/_AdminDashboard/dashboard.css">
</head>

<body>
    <?php require_once __DIR__ . "/../Admin/dash.php"; ?>


    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2>Dashboard</h2>
                <span>Welcome back, Admin</span>
            </div>

        </div>


        <div class="card--container">
            <div class="card--wrapper">
                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Total Sales</span>
                            <span class="amount--value">$24,780</span>
                        </div>
                        <i class="fa-solid fa-dollar-sign icon"></i>
                    </div>
                    <span class="card--detail">
                        ^12.5% vs last month
                    </span>
                </div>
                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Active Users</span>
                            <span class="amount--value">1.598</span>
                        </div>
                        <i class="fa-solid fa-users icon"></i>
                    </div>
                    <span class="card--detail">
                        ^8.2% vs last month
                    </span>
                </div>
                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">New Orders</span>
                            <span class="amount--value">450</span>
                        </div>
                        <i class="fa-solid fa-cart-plus icon"></i>
                    </div>
                    <span class="card--detail">
                        ^12.5% vs last month
                    </span>
                </div>
                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Revenue</span>
                            <span class="amount--value">$12,70</span>
                        </div>
                        <i class="fa-solid fa-chart-line icon"></i>
                    </div>
                    <span class="card--detail">
                        ^16.5% vs last month
                    </span>
                </div>

            </div>
        </div>



    </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".nav-link").forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    let page = this.getAttribute("data-page");

                    fetch(`/public/${page}`) // Update this path accordingly
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById("content-area").innerHTML = data;
                        })
                        .catch(error => console.error("Error loading page:", error));
                });
            });
        });
    </script>
</body>

</html>