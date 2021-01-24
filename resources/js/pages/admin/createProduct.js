const { UploadMasterProductImage } = require("../../config/Filepond");
// const FilePond = require("../../classes/main/FilePond");

document.addEventListener("DOMContentLoaded", () => {
    const mainImage = document.getElementById("mainImage");
    mainImageUpload = FilePond.create(mainImage, UploadMasterProductImage);
});

tail.select("#category", {
    search: true
});

const quill = new Quill("#editor", {
    theme: "snow"
});

document.getElementById("upload").addEventListener("click", event => {
    const form = document.querySelector("form");
    const disabled = form.querySelectorAll("input[disabled]");
    disabled.forEach(input => {
        input.disabled = false;
    });
    let wow = new FormData(form);
    for (let entry of wow.entries()) {
        console.log(entry);
    }
});
