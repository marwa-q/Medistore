"use strict";

let formFilled = false;
// Cart table

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
        // console.log(item);
        let row = `
        <tr>
            <td><img src="${item.img}" alt="${item.name}"></td>
            <td>${item.name}</td>
            <td>${item.price.toFixed(2)} $</td>
            <td class="quantity">
                <span>${item.quantity}</span>
            </td>
            <td>${(item.price * item.quantity).toFixed(2)} $</td>
        </tr>
        `;
        
        tbody.insertAdjacentHTML("beforeend", row);
    });
}

// Call function to render items on page load
renderCartItems();

function validateFormInputs(){
        let isValid = true;
        let fields = ["fullName", "phoneName", "address"];
    
        fields.forEach(field => {
            let input = document.getElementById(field);
            let errorSpan = document.getElementById(field + "Error");
            let value = input.value.trim();
            
            if (value === "") {
                errorSpan.textContent = "This field is required";
                errorSpan.style.color = "red";
                isValid = false;
            } else {
                errorSpan.textContent = "";
            }
    
            // Custom Validations
            if (field === "fullName" && value !== "") {
                let nameParts = value.split(" ");
                if (nameParts.length < 2) {
                    errorSpan.textContent = "Please enter at least first and last name";
                    errorSpan.style.color = "red";
                    isValid = false;
                }
            }
    
            if (field === "phoneName" && value !== "") {
                let phoneRegex = /^[0-9]{10,15}$/; // Adjust based on expected phone format
                if (!phoneRegex.test(value)) {
                    errorSpan.textContent = "Enter a valid phone number (10-15 digits)";
                    errorSpan.style.color = "red";
                    isValid = false;
                }
            }
        });
    
        if (isValid) {
            // Process form data and send to server here
            const successMessage = document.getElementById("successMessage");
            successMessage.style.display = "block";
            formFilled = true;
            document.getElementById("myForm").reset();
        }

}

document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault();
    validateFormInputs();
});

document.getElementById("placeOrderBtn").addEventListener("click", function(event){
    if(formFilled) {
        window.location.href = "../html/orderSent.html";
    } else {
        validateFormInputs();
    }
})

