class AddToCart {
    constructor() {
        this.cartButton = document.getElementById("cart");
        this.quantityInput = document.getElementById("quantity");
        this.initializer();
    }

    initializer() {
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
        this.cartFailed = new window.mdb.Toast(this.cartFailedNotification);
    }

    requestHandler() {
        if (!window.authenticated) {
            window.location.href = "/login";
        }

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
        return parseInt(this.quantityInput.value);
    }

    updateSelectedProduct(productId) {
        this.product = productId;
    }

    disableCart() {
        this.cartButton.disabled = true;
    }

    enableCart() {
        this.cartButton.disabled = false;
    }
}

export default AddToCart;
