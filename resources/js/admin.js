// window.QuillConverter = require("quill-delta-to-html").QuillDeltaToHtmlConverter;
window.Quill = require("./classes/main/Quill");
let AdminSidenav = require("./classes/admin/Sidenav");
const { ConfirmAction } = require("./classes/main/ConfirmAction");

// import ApexCharts from "apexcharts";

document.addEventListener("DOMContentLoaded", () => {
    new AdminSidenav();
    new ConfirmAction();
});
