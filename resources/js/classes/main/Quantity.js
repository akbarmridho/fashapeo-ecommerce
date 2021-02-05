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

    setQuantityLimit(limit) {
        this.quantityInput.max = limit;
    }
}

export { Quantity };
