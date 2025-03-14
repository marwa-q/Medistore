<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="/app/views/Cart/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <main>
        <div id="headline-section">
            <h2>Your Cart</h2>
        </div>
        <!-- Confirmation Modal -->
        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <p>Are you sure you want to remove this item from the cart?</p>
                <div id="confirm-buttons">
                    <button class="modal-button" id="confirmYes">Yes</button>
                    <button class="modal-button" id="confirmNo">No</button>
                </div>
            </div>
        </div>
        <section id="cart-section">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <?php foreach ($cartItems as $item) : ?>
                            <tr data-product-id="<?= $item['product_id'] ?>">
                                <td>
                                    <img src="<?= $item['image_url'] ?>" alt="Product Image" class="img-fluid cart-image">
                                </td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td class="cart-quantity">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button class="btn btn-sm btn-outline-secondary btn-minus cart-update-btn" data-product-id="<?= $item['product_id'] ?>" data-quantity="<?= $item['quantity'] - 1 ?>">−</button>
                                        <span class="mx-2"><?= $item['quantity'] ?></span>
                                        <button class="btn btn-sm btn-outline-primary btn-plus cart-update-btn" data-product-id="<?= $item['product_id'] ?>" data-quantity="<?= $item['quantity'] + 1 ?>">+</button>
                                    </div>
                                </td>
                                <td class="cart-total">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                <td>
                                    <button onclick="confirmRemove(this)" class="btn btn-sm btn-danger btn-trash cart-remove-btn" data-product-id="<?= $item['product_id'] ?>">🗑️</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </section>

        <form id="checkout-btn" action="/public/checkout" method="post">
            <button class="checkout-btn" id="checkout-btn">Checkout</button>
        </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle quantity update (increase/decrease)
            document.querySelectorAll(".cart-update-btn").forEach(button => {
                button.addEventListener("click", function() {
                    const productId = this.getAttribute("data-product-id");
                    const newQuantity = this.getAttribute("data-quantity");

                    fetch("/public/cart/update", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `product_id=${productId}&quantity=${newQuantity}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                window.location.reload();
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });

            // Handle item removal

            window.confirmRemove = function(button) {
                let modal = document.getElementById("confirmModal");
                modal.style.display = "flex";

                let productId = button.getAttribute("data-product-id"); // Get product ID from button

                document.getElementById("confirmYes").onclick = function() {
                    removeItem(productId); // Pass the product ID to removeItem
                    modal.style.display = "none";
                };

                document.getElementById("confirmNo").onclick = function() {
                    modal.style.display = "none";
                };
            }

            function removeItem(productId) {
                fetch("/public/cart/remove", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: `product_id=${productId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }

            // function removeItem(){
            //     document.querySelectorAll(".cart-remove-btn").forEach(button => {
            //     button.addEventListener("click", function() {
            //         const productId = this.getAttribute("data-product-id");

            //         fetch("/public/cart/remove", {
            //                 method: "POST",
            //                 headers: {
            //                     "Content-Type": "application/x-www-form-urlencoded"
            //                 },
            //                 body: `product_id=${productId}`
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.status === "success") {
            //                     window.location.reload();
            //                 } else {
            //                     alert(data.message);
            //                 }
            //             })
            //             .catch(error => console.error("Error:", error));
            //     });
            // });
            // }

            // Handle clear cart
            document.getElementById("clear-cart-btn").addEventListener("click", function() {
                fetch("/public/cart/clear", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="../js/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>