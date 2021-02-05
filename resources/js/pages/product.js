const AddToWishlist = require("../classes/main/AddToWishlist").default;
const ProductVariation = require("../classes/main/ProductVariation").default;

document.addEventListener("DOMContentLoaded", () => {
    new ProductVariation();
    new AddToWishlist();
    window.authenticated = new window.AuthCheck().customerCheck();
});
