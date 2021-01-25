const { UploadMasterProductImage } = require("../../config/Filepond");

document.addEventListener("DOMContentLoaded", () => {
    const mainImage = document.getElementById("mainImage");
    mainImageUpload = window.FilePond.create(
        mainImage,
        UploadMasterProductImage
    );
});

window.tail("#category", {
    search: true
});

const quill = new window.Quill("#editor", {
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
