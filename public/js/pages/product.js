const products = [
    {
        id: 1,
        size: "s",
        color: "white",
        price: 350000,
        image: "/img/celana1.jpg"
    },
    {
        id: 1,
        size: "s",
        color: "red",
        price: 360000,
        image: "/img/celana2.jpg"
    },
    {
        id: 1,
        size: "s",
        color: "blue",
        price: 370000,
        image: "/img/jacket1.jpg"
    },
    {
        id: 1,
        size: "m",
        color: "white",
        price: 380000,
        image: "/img/jacket2.jpg"
    },
    { id: 1, size: "m", color: "red", price: 390000, image: "/img/kaos1.jpg" },
    { id: 1, size: "m", color: "blue", price: 400000, image: "/img/kaos2.jpg" },
    {
        id: 1,
        size: "l",
        color: "white",
        price: 410000,
        image: "/img/kemeja1.jpg"
    },
    {
        id: 1,
        size: "l",
        color: "red",
        price: 420000,
        image: "/img/sepatu1.jpg"
    },
    { id: 1, size: "l", color: "blue", price: 430000, image: "/img/set1.jpg" },
    {
        id: 1,
        size: "xl",
        color: "white",
        price: 440000,
        image: "/img/kaos1.jpg"
    },
    { id: 1, size: "xl", color: "red", price: 450000, image: "/img/kaos2.jpg" },
    {
        id: 1,
        size: "xl",
        color: "blue",
        price: 460000,
        image: "/img/jacket2.jpg"
    }
];

class ProductImage {
    constructor() {
        this.productImage = document.getElementById("productImage");
        this.productImageThumbnails = document.getElementById(
            "productImageThumbnails"
        );
        this.imageGallery(this.imageList());
        this.eventListeners();
        this.setDefault();
    }

    eventListeners() {
        this.productImageThumbnails.addEventListener(
            "click",
            this.thumbnailHandler.bind(this)
        );

        this.productImage.addEventListener(
            "click",
            this.productImageHandler.bind(this)
        );
        this.slideChange();
    }

    setDefault() {
        const firstImage = this.images[0];
        this.changeProductImage(firstImage);
    }

    imageGallery(images) {
        this.lightbox = GLightbox({ elements: images });
    }

    imageList() {
        this.images = this.productImageThumbnails.querySelectorAll("img");
        return Array.from(this.images).map(element => {
            return {
                href: element.src,
                type: "image",
                index: element.dataset.index
            };
        });
    }

    changeProductImage(image) {
        this.productImage.style.backgroundImage = `url('${image.src}')`;
        this.productImage.dataset.index = image.dataset.index;
    }

    thumbnailHandler(event) {
        event.stopPropagation();
        let image = event.target.closest("img");
        if (image) {
            this.changeProductImage(image);
        }
    }

    productImageHandler(event) {
        this.lightbox.openAt(event.target.dataset.index);
    }

    slideChange() {
        this.lightbox.on("slide_changed", ({ prev, current }) => {
            const currentImageNode = this.images[current.index];
            this.changeProductImage(currentImageNode);
        });
    }
}

class Quantity {
    constructor() {
        this.incrementBtn = document.getElementById("increment");
        this.decrementBtn = document.getElementById("decrement");
        this.quantityInput = document.getElementById("quantity");
        this.initializeEventListener();
    }

    initializeEventListener() {
        this.incrementBtn.addEventListener(
            "click",
            this.incrementHandler.bind(this)
        );
        this.decrementBtn.addEventListener(
            "click",
            this.decrementHandler.bind(this)
        );
        this.quantityInput.addEventListener(
            "change",
            this.evaluateInput.bind(this)
        );
    }

    retreiveValue() {
        return parseInt(this.quantityInput.value);
    }

    evaluateInput() {
        const currentValue = this.retreiveValue();
        if (currentValue > 1) {
            this.decrementBtn.disabled = false;
        } else if (currentValue === 1) {
            this.decrementBtn.disabled = true;
        } else if (currentValue <= 0) {
            this.decrementBtn.disabled = true;
            this.quantityInput.value = 1;
        }
    }

    incrementHandler() {
        const newValue = this.retreiveValue() + 1;
        this.operate(newValue);
    }

    decrementHandler() {
        const newValue = this.retreiveValue() - 1;
        this.operate(newValue);
    }

    operate(newValue) {
        this.quantityInput.value = newValue;
        this.evaluateInput();
    }
}

class ProductVariations {
    constructor() {
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

new ProductImage();
new Quantity();
new ProductVariations();
