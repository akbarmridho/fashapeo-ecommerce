const { UploadMasterProductImage } = require("../../config/Filepond");
const { config } = require("../../config/Quill");
import ImageUploader from "quill-image-uploader";
import { QuillDeltaToHtmlConverter } from "quill-delta-to-html";

class UploadProduct {
    constructor(quill) {
        this.quill = quill;
        this.uploadButton = document.getElementById("upload");
        this.form = document.querySelector("form");
        this.failModal = new window.mdb.Modal(
            document.getElementById("uploadFailModal")
        );
        this.addListener();
    }

    addListener() {
        this.uploadButton.addEventListener(
            "click",
            this.handleUpload.bind(this)
        );
        this.form.addEventListener("change", this.validateInput.bind(this));
        // document.querySelectorAll(".filepond--root").forEach(element => {
        //     element.addEventListener(
        //         "FilePond:addfilestart",
        //         this.disableUploadButton.bind(this)
        //     );
        //     element.addEventListener(
        //         "FilePond:processfileprogress",
        //         this.disableUploadButton.bind(this)
        //     );
        //     element.addEventListener(
        //         "FilePond:updatefiles",
        //         this.enableUploadButton.bind(this)
        //     );
        // });
    }

    handleUpload() {
        let data = new FormData(this.form);

        const converter = new QuillDeltaToHtmlConverter(
            this.quill.getContents()["ops"]
        );
        data.append("description", converter.convert());
        data.append("_method", "PUT");

        this.setButtonLoadState();

        window.axios
            .post("", data)
            .then((response) => {
                this.unsetButtonLoadState();
                window.location.href = "/admin/products";
            })
            .catch((error) => {
                this.enableUploadButton();
                this.unsetButtonLoadState();
                this.showErrorModal();
                return error;
            });
    }

    disableUploadButton() {
        this.uploadButton.disabled = true;
    }

    enableUploadButton() {
        this.uploadButton.disabled = false;
    }

    setButtonLoadState() {
        this.uploadButton.innerHTML = `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Uploading...`;
    }

    unsetButtonLoadState() {
        this.uploadButton.innerHTML = `Upload`;
    }

    showErrorModal() {
        this.failModal.show();
    }

    validateInput() {
        if (
            this.form.querySelectorAll(`input[value=""]:required`).length !==
                0 ||
            this.form.querySelectorAll(`input:invalid`).length === 0
        ) {
            this.enableUploadButton();
        } else {
            this.disableUploadButton();
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const mainImage = document.getElementById("mainImage");
    const initialFiles = JSON.parse(
        mainImage.dataset.images.replace(`&quot;`, `"`)
    );
    UploadMasterProductImage.files = initialFiles;
    window.FilePond.create(mainImage, UploadMasterProductImage);
    window.tail("#category", {
        search: true,
    });
    window.Quill.register("modules/imageUploader", ImageUploader);
    const quill = new window.Quill("#editor", config);
    new UploadProduct(quill);
});
