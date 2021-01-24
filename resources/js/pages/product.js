const products = [
    {
        id: 1,
        size: "s",
        color: "white",
        price: 350000,
        image: "/img/celana1.jpg"
    },
    {
        id: 1,
        size: "s",
        color: "red",
        price: 360000,
        image: "/img/celana2.jpg"
    },
    {
        id: 1,
        size: "s",
        color: "blue",
        price: 370000,
        image: "/img/jacket1.jpg"
    },
    {
        id: 1,
        size: "m",
        color: "white",
        price: 380000,
        image: "/img/jacket2.jpg"
    },
    { id: 1, size: "m", color: "red", price: 390000, image: "/img/kaos1.jpg" },
    { id: 1, size: "m", color: "blue", price: 400000, image: "/img/kaos2.jpg" },
    {
        id: 1,
        size: "l",
        color: "white",
        price: 410000,
        image: "/img/kemeja1.jpg"
    },
    {
        id: 1,
        size: "l",
        color: "red",
        price: 420000,
        image: "/img/sepatu1.jpg"
    },
    { id: 1, size: "l", color: "blue", price: 430000, image: "/img/set1.jpg" },
    {
        id: 1,
        size: "xl",
        color: "white",
        price: 440000,
        image: "/img/kaos1.jpg"
    },
    { id: 1, size: "xl", color: "red", price: 450000, image: "/img/kaos2.jpg" },
    {
        id: 1,
        size: "xl",
        color: "blue",
        price: 460000,
        image: "/img/jacket2.jpg"
    }
];

const ProductImage = require("../classes/main/ProductImage");
const Quantity = require("../classes/main/Quantity");
const ProductVariation = require("../classes/main/ProductVariation");

new ProductImage();
new Quantity();
new ProductVariation(products);
