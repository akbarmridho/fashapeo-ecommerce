const UpdatePriceTotal = require("../../classes/main/UpdatePriceTotal").default;

document.addEventListener("DOMContentLoaded", () => {
    window.tail(".select-description", {
        descriptions: true,
    });
    new UpdatePriceTotal();
});
