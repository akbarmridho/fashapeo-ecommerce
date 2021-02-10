const UpdateWishlist = require("../../classes/main/UpdateWishlist").default;

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".wishlist").forEach((element) => {
        new UpdateWishlist(element);
    });
});
