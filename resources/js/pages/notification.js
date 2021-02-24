let ReadAll = require("../classes/main/ReadAllNotification").default;
let Notification = require("../classes/main/Notification").default;

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".bg-notification").forEach((notification) => {
        new Notification(notification);
    });
    // new ReadAll();
});
