
"use strict";

// This data should be fetched from the server
let cartItems = [
    {img: "../img/placeholder.jpg" , id: "1" , name: "Product 1" , quantity: 1 , price: 3.99},
    {img: "../img/placeholder.jpg" , id: "2" , name: "Product 2" , quantity: 2 , price: 5.99},
    {img: "../img/placeholder.jpg" , id: "3" , name: "Product 3" , quantity: 3 , price: 7.99}
];

// Function to render cart items
function renderCartItems() {
    let tbody = document.getElementById("cart-body");
    tbody.innerHTML = ""; // Clear existing rows
    
    cartItems.map(item => {
        let row = `
        <tr>
            <td><img src="${item.img}" alt="${item.name}"></td>
            <td>${item.name}</td>
            <td>${item.price.toFixed(2)} $</td>
            <td class="quantity">
                <button onclick="decreaseQuantity('${item.id}')">-</button>
                <span>${item.quantity}</span>
                <button onclick="increaseQuantity('${item.id}')">+</button>
            </td>
            <td>${(item.price * item.quantity).toFixed(2)} $</td>
            <td><button class="remove" onclick="confirmRemove('${item.id}')">&#10060;</button></td>
        </tr>`;
        
        tbody.insertAdjacentHTML("beforeend", row);
    });
}

// Call function to render items on page load
renderCartItems();

function increaseQuantity(id) {
    console.log(id);
    let item = cartItems.find(item => item.id === id);
    if (item) {
        item.quantity++;
        renderCartItems();
    }
}

function decreaseQuantity(id) {
    console.log(id);
    let item = cartItems.find(item => item.id === id);
    if (item && item.quantity > 1) {
        item.quantity--;
        renderCartItems();
    }

}


function confirmRemove(itemId) {
    let modal = document.getElementById("confirmModal");
    modal.style.display = "flex";

    document.getElementById("confirmYes").onclick = function() {
        removeItem(itemId);
        modal.style.display = "none";
    };

    document.getElementById("confirmNo").onclick = function() {
        modal.style.display = "none";
    };
}


function removeItem(id) {
    cartItems = cartItems.filter(item => item.id !== id);
    renderCartItems();
}

/*Coupon functionality*/

// This data should be fetched from the server
let validCoupons = [
    { code: "SAVE10", discount: 0.10 },
    { code: "WELCOME20", discount: 0.20 },
    { code: "SPRING30", discount: 0.30 }
];

/////////////////////////////////////////////////////////////////////////////

window.onload = function() {
    document.getElementById("couponCode").value = "";
};


function applyCoupon() {
    let couponInput = document.getElementById("couponCode").value.trim();
    let message = document.getElementById("couponMessage");
    
    // console.log(couponInput);

    if (couponInput === "") {
        message.style.color = "red";
        message.textContent = "Please enter a coupon code!";
        return;
    }

    // Find the matching coupon
    let foundCoupon = validCoupons.find(item => item.code === couponInput);
    console.log(foundCoupon);
    
    if (foundCoupon) {
        message.style.color = "green";
        message.textContent = `Coupon applied !`;
        //////////////////Apply discount logic here/////////////////////
    } else {
        message.style.color = "red";
        message.textContent = "Invalid coupon code!";
    }
}

document.getElementById("checkout-btn").addEventListener("click", () => {
//     if (isLoggedIn) {
        window.location.href = "./checkOut.html"; // Navigate to checkout page
//     } else {
//         window.location.href = "login.html"; // Navigate to login page
//     }
});

calculateTotal(); // Run function on page load
