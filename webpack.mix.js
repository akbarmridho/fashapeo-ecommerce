const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/admin.js", "public/js")
    .js("resources/js/pages/main.js", "public/js/pages")
    .js("resources/js/pages/product.js", "public/js/pages")
    .js("resources/js/pages/notification.js", "public/js/pages")
    .js("resources/js/pages/customer/cart.js", "public/js/pages/customer")
    .js("resources/js/pages/customer/wishlist.js", "public/js/pages/customer")
    .js(
        "resources/js/pages/customer/createAddress.js",
        "public/js/pages/customer"
    )
    .js("resources/js/pages/customer/shipment.js", "public/js/pages/customer")
    .js("resources/js/pages/auth/register.js", "public/js/pages/auth")
    .js("resources/js/pages/admin/categories.js", "public/js/pages/admin")
    .js(
        "resources/js/pages/admin/editSingleVariantProduct.js",
        "public/js/pages/admin"
    )
    .js(
        "resources/js/pages/admin/editMultiVariantProduct.js",
        "public/js/pages/admin"
    )
    .js("resources/js/pages/admin/createCarousel.js", "public/js/pages/admin")
    .js("resources/js/pages/admin/createProduct.js", "public/js/pages/admin")
    .js("resources/js/pages/admin/variations.js", "public/js/pages/admin")
    .postCss("resources/css/app.css", "public/css")
    .postCss("resources/css/admin.css", "public/css");
