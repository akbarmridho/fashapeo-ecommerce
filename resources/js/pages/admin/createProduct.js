const { UploadMasterProductImage } = require("../../config/Filepond");
const ProductVariant = require("../../classes/admin/ProductVariant");
const { config } = require("../../config/Quill");
import ImageUploader from "quill-image-uploader";
import { QuillDeltaToHtmlConverter } from "quill-delta-to-html";

document.addEventListener("DOMContentLoaded", () => {
    window.FilePond.create(
        document.getElementById("mainImage"),
        UploadMasterProductImage
    );

    window.tail("#category", {
        search: true
    });

    window.Quill.register("modules/imageUploader", ImageUploader);
    const quill = new window.Quill("#editor", config);

    const variant = new ProductVariant();

    document.getElementById("upload").addEventListener("click", event => {
        const form = document.querySelector("form");
        const disabled = form.querySelectorAll("input[disabled]");
        const converter = new QuillDeltaToHtmlConverter(
            quill.getContents()["ops"]
        );
        disabled.forEach(input => {
            input.disabled = false;
        });
        let data = new FormData(form);
        data.append("description", converter.convert());
        for (let entry of data.entries()) {
            console.log(entry);
        }
    });
});
