<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Div</title>
    <style>
        * {
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

        h2,
        p {
            color: var(--dark-grey);
        }

        .container {
            background: var(--white);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 80%;
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
            border-radius: 5px;
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
            <img src="/app/views/Checkout/checked.png" alt="Sent successfully">
            <h2>Thank you for order !</h2>
            <p>Your order has been sent successfully</p>
            <a href="/public/product">Back to Home</a>
        </div>
    </div>



</body>

</html>