const { UploadProductImage } = require("../../config/Filepond");

class VariantInput {
    constructor() {
        this.copyTemplate();
    }

    copyTemplate() {
        this.variantLabel = document
            .getElementById("variantName")
            .content.querySelector("td")
            .cloneNode(true);

        this.variantInput = document
            .getElementById("variantInput")
            .content.querySelector("tr")
            .cloneNode(true);
    }

    createVariant(combination) {
        let row = document.createElement("tr");
        for (let variant of Object.keys(combination.variant)) {
            let label = this.createVariantLabel(
                variant,
                combination.variant[variant],
                combination.id
            );
            row.appendChild(label);
        }
        for (let element of this.createVariantInput(combination.id)) {
            row.appendChild(element);
        }

        return row;
    }

    createVariantLabel(name, value, i) {
        let label = this.variantLabel.cloneNode(true);
        let labelInput = label.querySelector("input");
        labelInput.name = `variants[${i}][${name}]`;
        labelInput.value = value;

        return label;
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

    initializeImageInput(input) {
        window.FilePond.create(
            input.querySelector(".filepond"),
            UploadProductImage
        );
    }
}

module.exports = VariantInput;
