const AddToWishlist = require("../classes/main/AddToWishlist");
const ProductVariation = require("../classes/main/ProductVariation");

document.addEventListener("DOMContentLoaded", () => {
    new ProductVariation();
    new AddToWishlist();
});
