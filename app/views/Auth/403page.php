<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anauthorized access</title>
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    border: none;
    outline: none;
    list-style-type: none;
    scroll-behavior: smooth;
    font-family: 'Open Sans', sans-serif;
    }

html {
    overflow-x: hidden;
}

:root {
    --darkBlue: #1E3A8A;
    --light-blue: #009cff;
    --Medium-blue: #3B82F6;
    --danger-red: #DC3545;
    --dark-grey: #333333;
    --black: #000000;
    --white: #FFFFFF;
    --soft-grey: #F5F5F5;
}

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            padding: 20px;
        }

        #content {
            padding: 20px;
        }

        h2 , p {
            color: var(--dark-grey);
        }

        .container {
            background: var(--white);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 80vw;
            max-width: 400px;
        }

        img {
            width: 70px;
            margin-bottom: 20px;
        }

        button {
            margin-top: 30px;
            padding: 10px 20px;
            background: var(--darkBlue);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: var(--Medium-blue);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                width: 95%;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="content">
            <img src="../img/warning.png" alt="warning">
            <h1><strong>403</strong></h1>
            <h2>Anauthorized access</h2>
            <?php echo "<p>$message</p>"?>
            <button onclick="navigateToIndex()">Back to Home</button>
        </div>
    </div>

    <script>
        function navigateToIndex() {
            <?php echo header("Location: /public/product"); ?>
        }
    </script>

</body>
</html>