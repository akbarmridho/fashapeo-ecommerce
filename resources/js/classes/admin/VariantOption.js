class VariantOption {
    constructor(variantElement, variantTable, variantId) {
        this.variantId = variantId;
        this.variantElement = variantElement;
        this.variantTable = variantTable;
        this.variantCounter = 0;
        this.labelContainer = this.variantElement.querySelector("div");
        this.variantInput = this.variantElement.querySelector("input");
        this.initialize();
    }

    initialize() {
        this.copyTemplate();
        this.setInputListener();
    }

    copyTemplate() {
        this.variantLabel = document.getElementById(
            "variantLabel"
        ).content.children[0];
        this.variantLabelIcon = document.getElementById(
            "variantLabel"
        ).content.children[1];
    }

    setInputListener() {
        this.variantInput.addEventListener(
            "keyup",
            this.inputHandler.bind(this)
        );
    }

    setLabelListener(label) {
        label.addEventListener(
            "click",
            this.deleteLabelHandler.bind(this, label)
        );
    }

    inputHandler(event) {
        event.preventDefault();
        event.stopPropagation();
        if (event.key === "Enter") {
            event.target.value.split(",").forEach(variant => {
                if (variant.trim() !== "") {
                    this.createLabel(variant);
                    this.variantTable.createOption(variant, this.variantId);
                }
                event.target.value = "";
            });
        }
    }

    deleteLabelHandler(label) {
        label.remove();
        this.variantCounter--;
        this.variantTable.deleteOption(
            label.dataset.optionName,
            this.variantId
        );
        this.validateCounter();
    }

    createLabel(value) {
        if (this.variantCounter === 10) {
            return;
        }

        let label = this.variantLabel.cloneNode(true);

        label.appendChild(document.createTextNode(value));
        label.append(this.variantLabelIcon.cloneNode(true));
        label.dataset.optionName = value;
        this.labelContainer.appendChild(label);

        this.setLabelListener(label);
        this.variantCounter++;

        this.validateCounter();
    }

    validateCounter() {
        if (this.variantCounter >= 10) {
            this.variantInput.classList.add("is-invalid");
        } else {
            if (this.variantInput.classList.contains("is-invalid")) {
                this.variantInput.classList.remove("is-invalid");
            }
        }
    }
}

module.exports = VariantOption;
