class ProductVariation {
    constructor(products) {
        this.products = products;
        this.price = document.getElementById("price");
        this.variations = document.querySelectorAll("#variant");
        this.form = document.getElementById("variations");
        this.initializer();
    }

    initializer() {
        this.retreiveVariations();
        this.clickListener();
    }

    retreiveVariations() {
        const variations = document.querySelectorAll("#variant");
        let selectionDivElements = [];
        this.variationName = [];
        variations.forEach(variation => {
            this.variationName.push(variation.dataset.variant);
            const variants = variation.querySelectorAll("div");
            variants.forEach(variant => selectionDivElements.push(variant));
        });
        this.selectionDivElements = selectionDivElements;
    }

    clickListener() {
        this.selectionDivElements.forEach(element => {
            element
                .querySelector("input")
                .addEventListener("change", this.evaluator.bind(this));
        });
    }

    evaluator() {
        let selected = [];

        this.variationName.forEach(name => {
            const selectedValue = this.form.elements[name].value;
            if (selectedValue === "" || selectedValue === null) {
                return;
            }

            selected.push({ name: name, value: selectedValue });
        });

        if (selected.length === this.variationName.length) {
            this.filterVariants(products, selected);
        }
    }

    filterVariants(variants, selectedData) {
        let filtered = variants;

        for (const data of selectedData) {
            filtered = filtered.filter(variant => {
                if (variant[data.name] === data.value) {
                    return variant;
                }
            });
        }

        if (filtered.length === 1) {
            this.applyChange(filtered[0]);
        }
    }

    applyChange(product) {
        this.price.textContent = product.price.toLocaleString("id");
        // this.productImage = document.getElementById("productImage");
        // this.productImage.style.backgroundImage = `url('${product.image}')`;
    }
}

module.exports = ProductVariation;