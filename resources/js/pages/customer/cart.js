const UpdateCart = require("../../classes/main/UpdateCart").default;

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".product-cart").forEach((cart) => {
        new UpdateCart(cart);
    });
});
