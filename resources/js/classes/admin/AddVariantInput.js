const { UploadProductImage } = require("../../config/Filepond");

class AddVariantInput {
    constructor() {
        this.copyTemplate();
        this.counter = 1;
    }

    copyTemplate() {
        this.variantInput = document
            .getElementById("variantInput")
            .content.querySelector("tr")
            .cloneNode(true);
    }

    createVariant() {
        let row = document.createElement("tr");
        for (let element of this.createVariantInput(this.counter)) {
            row.appendChild(element);
        }
        this.counter++;
        this.createDeleteListener(row);
        return row;
    }

    createVariantInput(i) {
        let input = this.variantInput.cloneNode(true);
        input.querySelectorAll("input").forEach(element => {
            let name = element.name.split("?");
            element.name = name[0] + i + name[1];
        });
        this.initializeImageInput(input);
        return input.querySelectorAll("td");
    }

    createDeleteListener(row) {
        row.querySelector("button").addEventListener(
            "click",
            () => {
                row.remove();
            },
            { once: true }
        );
    }

    initializeImageInput(input) {
        window.FilePond.create(
            input.querySelector(".filepond"),
            Object.assign({}, UploadProductImage)
        );
    }
}

module.exports = AddVariantInput;
