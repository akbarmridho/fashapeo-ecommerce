class UpdateCart {
    constructor(element) {
        this.incrementBtn = element.querySelector(".increment");
        this.decrementBtn = element.querySelector(".decrement");
        this.quantityInput = element.querySelector(".quantity");
        this.deleteButton = element.querySelector(".cart-delete");
        this.pending = false;
        this.productId = element.dataset.id;
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
        this.deleteButton.addEventListener("click", this.deleteCart.bind(this));
    }

    retreiveValue() {
        return parseInt(this.quantityInput.value);
    }

    evaluateInput() {
        const currentValue = this.retreiveValue();
        if (currentValue > 1) {
            this.decrementBtn.disabled = false;
            this.updateQuantityTimer();
        } else if (currentValue === 1) {
            this.decrementBtn.disabled = true;
            this.updateQuantityTimer();
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

    updateQuantityTimer() {
        if (!this.pending) {
            this.pending = true;
            setTimeout(() => {
                this.updateQuantity();
                this.pending = false;
            }, 1000);
        }
    }

    updateQuantity() {
        let data = new FormData();
        data.append("id", this.productId);
        data.append("quantity", this.retreiveValue());
        data.append("_method", "PUT");
        window.axios.post("/cart", data);
    }

    deleteCart() {
        window.axios.delete(`/cart/${this.productId}`);
    }
}

export default UpdateCart;
