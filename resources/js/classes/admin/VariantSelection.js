const Multivariant = require("./Multivariant");
const VariantOption = require("./VariantOption");

class VariantSelection {
    constructor(variantTable) {
        this.variantTable = new Multivariant(variantTable);
        this.variantContainer = document.getElementById("variantContainer");
        this.initializeSelection();
        this.copyTemplate();
    }

    copyTemplate() {
        this.variantOptions = document
            .getElementById("variantOptions")
            .content.firstElementChild.cloneNode(true);
    }

    initializeSelection() {
        this.selection = tail
            .select(".select-move", {
                search: true,
                hideSelected: false,
                hideDisabled: true,
                multiLimit: 2,
                multiShowCount: false,
                multiContainer: true
            })
            .on("change", this.changeHandler.bind(this));
    }

    remove() {
        this.selection.remove();
    }

    changeHandler(item, state) {
        if (state === "select") {
            this.addVariant(item);
        } else if (state === "unselect") {
            this.removeVariant(item);
        }
    }

    addVariant(item) {
        let variantElement = this.variantOptions.cloneNode(true);
        variantElement.id = `variant${item.value}`;
        variantElement.querySelector("h5").innerText = item.value + ":";
        this.variantContainer.appendChild(variantElement);
        new VariantOption(variantElement, this.variantTable, item.key);
        this.variantTable.createVariant(item.value, item.key);
    }

    removeVariant(item) {
        let variantElement = document.getElementById(`variant${item.value}`);
        variantElement.remove();
        this.variantTable.deleteVariant(item.key);
    }
}

module.exports = VariantSelection;
