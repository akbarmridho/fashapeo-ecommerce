const VariantInput = require("./VariantInput");

class Multivariant {
    constructor(tableContainer) {
        this.container = tableContainer;
        this.tableHead = this.container
            .querySelector("thead")
            .querySelector("tr");
        this.tableBody = this.container.querySelector("tbody");
        this.rowCreator = new VariantInput();
        this.variants = [];
        this.variantCombinations = [];
    }

    createVariant(name, id) {
        let head = document.createElement("th");
        head.textContent = name;
        this.variants.push({
            id: id,
            name: name,
            element: head,
            options: []
        });
        if (this.variants.length >= 2) {
            this.tableHead.firstElementChild.parentNode.insertBefore(
                head,
                this.tableHead.firstElementChild.nextElementSibling
            );
        } else {
            this.tableHead.prepend(head);
        }
        this.tableBody.innerHTML = "";
        this.variantCombinations = [];
        this.updateUsedVariantInput();
    }

    deleteVariant(id) {
        this.variants.forEach((variant, index) => {
            if (variant.id === id) {
                this.variants.splice(index, 1);
                variant.element.remove();
            }
        });
        this.tableBody.innerHTML = "";
        this.updateUsedVariantInput();
    }

    updateUsedVariantInput() {
        let variants = [];
        this.variants.forEach(variant => {
            variants.push(`${variant.name}:${variant.id}`);
        });
        let input = document.getElementById("usedVariant");
        input.value = variants.join(",");
    }

    createVariantCombination(option) {
        if (this.variants.length === 1) {
            let combination = {
                id: this.createVariantCombinationId(),
                variant: {
                    [option.variantName]: option.name
                }
            };
            combination.element = this.rowCreator.createVariant(combination);
            this.tableBody.appendChild(combination.element);
            this.variantCombinations.push(combination);
        } else if (this.variants.length >= 1) {
            this.variants.forEach(variant => {
                if (
                    variant.id !== option.variantId &&
                    variant.options.length !== 0
                ) {
                    variant.options.forEach(otherOption => {
                        let combination = {
                            id: this.createVariantCombinationId(),
                            variant: null,
                            element: null
                        };
                        if (variant.id > option.variantId) {
                            combination.variant = {
                                [option.variantName]: option.name,
                                [otherOption.variantName]: otherOption.name
                            };
                        } else {
                            combination.variant = {
                                [otherOption.variantName]: otherOption.name,
                                [option.variantName]: option.name
                            };
                        }
                        combination.element = this.rowCreator.createVariant(
                            combination
                        );
                        this.tableBody.appendChild(combination.element);
                        this.variantCombinations.push(combination);
                    });
                }
            });
        }
    }

    createVariantCombinationId() {
        if (this.variantCombinations.length === 0) {
            return 1;
        } else {
            const lastCombination = this.variantCombinations[
                this.variantCombinations.length - 1
            ];
            return parseInt(lastCombination.id) + 1;
        }
    }

    createOption(name, variantId) {
        this.variants.forEach(variant => {
            if (variant.id === variantId) {
                let option = {
                    id: parseInt(variant.options.length) + 1,
                    variantId: variantId,
                    variantName: variant.name,
                    name: name
                };
                variant.options.push(option);
                this.createVariantCombination(option);
            }
        });
    }

    deleteOption(name, variantId) {
        this.variants.forEach(variant => {
            if (variant.id === variantId) {
                variant.options = variant.options.filter(
                    option => option.name !== name
                );
                let toDeleteCombination = this.variantCombinations.filter(
                    com => {
                        return Object.values(com.variant).includes(name);
                    }
                );
                for (let combination of toDeleteCombination) {
                    combination.element.remove();
                }
                this.variantCombinations = this.variantCombinations.filter(
                    combination => {
                        return !Object.values(combination.variant).includes(
                            name
                        );
                    }
                );
            }
        });
    }
}

module.exports = Multivariant;
