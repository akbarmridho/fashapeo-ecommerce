const VariantSelection = require("./VariantSelection");

class ProductVariant {
    constructor() {
        this.variantContentElement = document.getElementById("variantContent");
        this.productSetting = document.getElementById("productSetting");
        this.initializer();
    }

    initializer() {
        this.addVariantButtonListener();
        this.copyTemplate();
    }

    copyTemplate() {
        this.multivariantTemplateElement = document
            .getElementById("multiVariant")
            .cloneNode(true);
        this.singleProductSetting = this.productSetting.cloneNode(true);
        this.multiProductSetting = document
            .getElementById("variantsTable")
            .content.firstElementChild.cloneNode(true);
        this.addVariantButtonElement = this.addVariantButton.cloneNode(true);
    }

    addRemoveVariantButtonListener() {
        this.removeVariantButton.addEventListener(
            "click",
            this.removeVariantHandler.bind(this)
        );
    }

    removeRemoveVariantButtonListener() {
        this.removeVariantButton.removeEventListener(
            "click",
            this.removeVariantHandler.bind(this)
        );
    }

    addVariantButtonListener() {
        this.addVariantButton = document.getElementById("addVariant");
        this.addVariantButton.addEventListener(
            "click",
            this.addVariantHandler.bind(this)
        );
    }

    removeAddVariantButtonListener() {
        this.addVariantButton.removeEventListener(
            "click",
            this.removeVariantHandler.bind(this)
        );
    }

    addVariantHandler() {
        this.variantContentElement.innerHTML = this.multivariantTemplateElement.innerHTML;
        this.removeVariantButton = document.getElementById("removeVariant");
        this.initializeSelection();
        this.removeAddVariantButtonListener();
        this.addRemoveVariantButtonListener();
    }

    removeVariantHandler() {
        this.variantContentElement.innerHTML = "";
        this.variantContentElement.appendChild(this.addVariantButtonElement);
        this.removeRemoveVariantButtonListener();
        this.addVariantButtonListener();
        this.addSingleVariant();
        this.removeSelection();
    }

    initializeSelection() {
        this.selection = new VariantSelection(this.addMultiVariant());
    }

    addMultiVariant() {
        this.productSetting.innerHTML = "";
        this.productSetting.append(this.multiProductSetting.cloneNode(true));
        return this.productSetting;
    }

    addSingleVariant() {
        this.productSetting.innerHTML = "";
        this.productSetting.append(this.singleProductSetting.cloneNode(true));
    }

    removeSelection() {
        this.selection.remove();
        this.selection = null;
    }
}

module.exports = ProductVariant;
