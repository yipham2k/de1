document.addEventListener("DOMContentLoaded", function () {
    // Đổi ảnh chính khi click vào thumbnail
    const thumbnails = document.querySelectorAll(".thumbnail");
    const mainImage = document.querySelector(".main-image");

    thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener("click", function () {
            mainImage.src = this.src;
        });
    });

    // Xử lý tăng/giảm số lượng
    const quantityInput = document.getElementById("quantity");
    const increaseBtn = document.querySelector(".btn-quantity:last-child");
    const decreaseBtn = document.querySelector(".btn-quantity:first-child");

    increaseBtn.addEventListener("click", function () {
        let value = parseInt(quantityInput.value);
        let max = parseInt(quantityInput.getAttribute("max"));
        if (value < max) {
            quantityInput.value = value + 1;
        }
    });

    decreaseBtn.addEventListener("click", function () {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });

    // Xử lý thêm vào giỏ hàng
    const addToCartBtn = document.querySelector(".btn-add-to-cart");
    addToCartBtn.addEventListener("click", function () {
        const productId = this.dataset.id;
        const quantity = quantityInput.value;

        fetch(`/api/cart/add`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Sản phẩm đã được thêm vào giỏ hàng");
                    // Cập nhật số lượng sản phẩm trong giỏ hàng ở header
                    document.querySelector(".cart-count").textContent =
                        data.cartCount;
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
