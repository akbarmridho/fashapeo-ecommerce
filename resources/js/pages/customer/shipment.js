const UpdatePriceTotal = require("../../classes/main/UpdatePriceTotal").default;

document.addEventListener("DOMContentLoaded", () => {
    tail.select(".select-description", {
        descriptions: true,
    });
    new UpdatePriceTotal();
});
