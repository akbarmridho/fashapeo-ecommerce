class UpdateCart {
    constructor(element) {
        this.element = element;
        this.incrementBtn = element.querySelector(".increment");
        this.decrementBtn = element.querySelector(".decrement");
        this.quantityInput = element.querySelector(".quantity");
        this.deleteButton = element.querySelector(".cart-delete");
        this.noteInput = element.querySelector(".cart-note");
        this.pending = false;
        this.productId = element.dataset.id;
        this.initializeEventListener();
        this.getNotificationElement();
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
        this.noteInput.addEventListener(
            "change",
            this.evaluateInput.bind(this)
        );
        this.deleteButton.addEventListener("click", this.deleteCart.bind(this));
    }

    getNotificationElement() {
        this.cartUpdatedNotification = document.getElementById("cartUpdated");
        this.cartDeletedNotificaiton = document.getElementById("cartDelete");
        this.cartFailedNotification = document.getElementById("cartFailed");
        this.initializeToast();
    }

    initializeToast() {
        this.cartUpdated = new window.mdb.Toast(this.cartUpdatedNotification);
        this.cartDeleted = new window.mdb.Toast(this.cartDeletedNotificaiton);
        this.cartFailed = new window.mdb.Toast(this.cartFailedNotification);
    }

    retreiveQuantity() {
        return parseInt(this.quantityInput.value);
    }

    retreiveNote() {
        return this.noteInput.value;
    }

    evaluateInput() {
        const currentValue = this.retreiveQuantity();
        if (currentValue > 1) {
            this.decrementBtn.disabled = false;
            this.setTimer();
        } else if (currentValue === 1) {
            this.decrementBtn.disabled = true;
            this.setTimer();
        } else if (currentValue <= 0) {
            this.decrementBtn.disabled = true;
            this.quantityInput.value = 1;
        }
    }

    incrementHandler() {
        const newValue = this.retreiveQuantity() + 1;
        this.operate(newValue);
    }

    decrementHandler() {
        const newValue = this.retreiveQuantity() - 1;
        this.operate(newValue);
    }

    operate(newValue) {
        this.quantityInput.value = newValue;
        this.evaluateInput();
    }

    setTimer() {
        if (!this.pending) {
            this.pending = true;
            setTimeout(() => {
                this.updateCart();
                this.pending = false;
            }, 1000);
        }
    }

    updateCart() {
        let data = new FormData();
        data.append("id", this.productId);
        data.append("quantity", this.retreiveQuantity());
        data.append("note", this.retreiveNote());
        data.append("_method", "PUT");
        window.axios
            .post("/cart", data)
            .then((response) => {
                this.cartUpdated.show();
            })
            .catch((error) => {
                this.cartFailed.show();
            });
    }

    deleteCart() {
        this.disableDeleteCartButton();
        window.axios
            .delete(`/cart/${this.productId}`)
            .then((response) => {
                this.cartDeleted.show();
                this.removeElement();
                window.location.reload();
            })
            .catch((error) => {
                this.cartFailed.show();
                this.enableDeleteCartButton();
            });
    }

    disableDeleteCartButton() {
        this.deleteButton.disabled = true;
    }

    enableDeleteCartButton() {
        this.deleteButton.disabled = false;
    }

    removeElement() {
        this.element.remove();
    }
}

export default UpdateCart;
