 // عند تحميل الصفحة، اجعل المحتوى شفافًا مؤقتًا
 document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".content").classList.add("hidden");
});

// بعد تحميل الصفحة، أزل التأثير وأخفِ السبينر
window.onload = function() {
    let spinner = document.getElementById("spinner");
    let content = document.querySelector(".content");

    // إخفاء السبينر مع تأثير
    spinner.classList.add("hidden");

    // إظهار المحتوى بعد اختفاء السبينر
    setTimeout(() => {
        content.classList.remove("hidden");
    }, 500); // تأخير بسيط لجعل الانتقال سلسًا
};

// دالة لتفعيل أو إخفاء القائمة عند النقر على زر القائمة المتجاوبة
function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active'); // إضافة أو إزالة الكلاس "active"
}
//function toggleMenu() {
 //   document.querySelector(".nav-links").classList.toggle("active");
//}

//function toggleDropdown(event) {
 //   event.stopPropagation();
   // let dropdown = event.currentTarget;
 //   dropdown.classList.toggle("active");
//}

//document.addEventListener("click", function(event) {
  //  let dropdowns = document.querySelectorAll(".dropdown");
  //  dropdowns.forEach(dropdown => {
     //   if (!dropdown.contains(event.target)) {
      //      dropdown.classList.remove("active");
      //  }
    //});
//});
var swiper = new Swiper(".swiper-container", {
    loop: true,
    autoplay: {
        delay: 3000, /* مدة الانتقال بين الصور */
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});


var swiper = new Swiper(".swiper-container", {
    loop: true,  // للتكرار التلقائي للصور
    autoplay: {
        delay: 3000,  // مدة الانتقال بين الصور (بالملي ثانية)
        disableOnInteraction: false,  // يبقى يعمل عند التفاعل مع السلايدر
    },
    navigation: {
        nextEl: ".swiper-button-next",  // زر السهم التالي
        prevEl: ".swiper-button-prev",  // زر السهم السابق
    },
});

document.querySelectorAll("ul button").forEach(button => {
    button.addEventListener("click", function() {
        // إزالة الـ active من كل الأزرار
        document.querySelectorAll("ul button").forEach(btn => btn.classList.remove("active"));
        
        // إضافة الـ active للزر الذي تم النقر عليه
        this.classList.add("active");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // تحديد كل أيقونات القلب
    document.querySelectorAll(".wishlist").forEach(wishlist => {
        wishlist.addEventListener("click", function (event) {
            event.preventDefault(); // منع الانتقال للرابط
            let heartIcon = this.querySelector("i");
            heartIcon.classList.toggle("fa-regular");
            heartIcon.classList.toggle("fa-solid");
            heartIcon.style.color = heartIcon.classList.contains("fa-solid") ? "red" : "black";
        });
    });

    // تحديد كل أزرار السلة
    document.querySelectorAll(".cart-btn").forEach(cartBtn => {
        cartBtn.addEventListener("click", function () {
            this.innerHTML = '<i class="fa-solid fa-cart-shopping"></i> Added';
            this.style.backgroundColor = "#1E3A8A"; // تغيير لون الزر بعد الإضافة
            this.style.color = "white";
        });
    });
});

// Get the buttons تيستمونيا
// Get the buttons
// Select elements
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
const slider = document.querySelector('.testimonial-slider');
const cards = document.querySelectorAll('.testimonial-card');
let currentIndex = 0; // Keep track of the current card index

// Set the initial transform of the slider
slider.style.transform = `translateX(0)`;

// Function to move to the previous card
function movePrev() {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = cards.length - 1; // Loop back to the last card
    }
    updateSliderPosition();
}

// Function to move to the next card
function moveNext() {
    if (currentIndex < cards.length - 1) {
        currentIndex++;
    } else {
        currentIndex = 0; // Loop back to the first card
    }
    updateSliderPosition();
}

// Update the slider position based on the current index
function updateSliderPosition() {
    const cardWidth = cards[0].offsetWidth + 20; // Include margin (20px)
    slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
}

// Event listeners for buttons
prevBtn.addEventListener('click', movePrev);
nextBtn.addEventListener('click', moveNext);

// Optional: Auto-move every 4 seconds
setInterval(moveNext, 4000);
