class AddToCart {
    constructor() {
        this.cartButton = document.getElementById("cart");
        this.quantityInput = document.getElementById("quantity");
    }

    initialize() {
        this.cartButton.addEventListener(
            "click",
            this.requestHandler.bind(this)
        );
        this.getNotificationElement();
    }

    getNotificationElement() {
        this.cartSuccessNotification = document.getElementById("cartSuccess");
        this.cartDuplicateNotification = document.getElementById(
            "cartDuplicate"
        );
        this.cartFailedNotification = document.getElementById("cartFailed");
        this.initializeToast();
    }

    initializeToast() {
        this.cartSuccess = new window.mdb.Toast(this.cartSuccessNotification);
        this.cartDuplicate = new window.mdb.Toast(
            this.cartDuplicateNotification
        );
        this.cartFailed = new window.mdb.Toas(this.cartFailedNotification);
    }

    requestHandler() {
        window.axios
            .post("/cart", {
                id: this.product,
                quantity: this.getQuantity(),
            })
            .then((response) => {
                this.cartSuccess.show();
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    this.cartDuplicate.show();
                } else {
                    this.cartFailed.show();
                }
            });
    }

    getQuantity() {
        return parse_int(this.quantityInput.value);
    }

    updateSelectedProduct(productId) {
        this.product = productId;
    }

    disableCart() {
        this.cartButton.disabled = true;
    }
}

export default AddToCart;
