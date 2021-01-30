const RowCreator = require("./AddVariantInput");

class AddProductVariant {
    constructor() {
        this.rowCreator = new RowCreator();
        this.lastRow = document.getElementById("addVariantRow");
        this.addVariantButton = document.getElementById("addVariant");
        this.initializeListener();
    }

    initializeListener() {
        this.addVariantButton.addEventListener(
            "click",
            this.actionHandler.bind(this)
        );
    }

    actionHandler() {
        const newVariant = this.rowCreator.createVariant();
        this.lastRow.parentElement.insertBefore(newVariant, this.lastRow);
    }
}

module.exports = AddProductVariant;
