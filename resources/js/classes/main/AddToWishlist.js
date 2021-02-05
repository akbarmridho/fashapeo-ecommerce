class AddToWishlist {
    constructor() {
        this.wishlistButton = document.getElementById("wishlist");
        this.initializer();
    }

    initializer() {
        this.getNotificationElement();
        this.initializeListener();
    }

    initializeListener() {
        this.wishlistButton.addEventListener("click", () => {
            if (this.wishlistButton.dataset.state === "selected") {
                this.removeFromWishlistHandler();
            } else {
                this.addToWishlistHandler();
            }
        });
    }

    getNotificationElement() {
        this.wishlistSuccessNotification = document.getElementById(
            "wishlistSuccess"
        );
        this.wishlistDuplicateNotification = document.getElementById(
            "wishlistDuplicate"
        );
        this.wishlistFailedNotification = document.getElementById(
            "wishlistFailed"
        );
        this.wishlistDeleteNotification = document.getElementById(
            "wishlistDelete"
        );
        this.initializeToast();
    }

    initializeToast() {
        this.wishlistSuccess = new window.mdb.Toast(
            this.wishlistSuccessNotification
        );
        this.wishlistDuplicate = new window.mdb.Toast(
            this.wishlistDuplicateNotification
        );
        this.wishlistFailed = new window.mdb.Toast(
            this.wishlistFailedNotification
        );
        this.wishlistDelete = new window.mdb.Toast(
            this.wishlistDeleteNotification
        );
    }

    addToWishlistHandler() {
        if (!window.authenticated) {
            window.location.href = "/login";
        }
        this.setAsLoading();
        window.axios
            .post("/wishlist", {
                id: this.getId(),
            })
            .then((response) => {
                this.wishlistSuccess.show();
                this.setAsAdded();
                this.updateId(response.id);
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    this.wishlistDuplicate.show();
                    this.setAsAdded();
                } else {
                    this.wishlistFailed.show();
                    this.setAsNotAdded();
                }
            });
    }

    removeFromWishlistHandler() {
        this.setAsLoading();
        window.axios
            .delete(`/wishlist/${this.getId()}`)
            .then((response) => {
                this.wishlistDelete.show();
                this.setAsNotAdded();
                this.updateId(response.id);
            })
            .catch((error) => {
                this.wishlistFailed.show();
                this.setAsAdded;
            });
    }

    getId() {
        return parseInt(this.wishlistButton.dataset.id);
    }

    setAsNotAdded() {
        const icon = `<i class="far fa-heart mr-2">`;
        this.wishlistButton.innerHTML = icon;
        this.enableButton();
    }

    setAsLoading() {
        const spinner = `<div class="spinner-grow spinner-grow-sm text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>`;
        this.wishlistButton.innerHTML = spinner;
        this.disableButton();
    }

    setAsAdded() {
        const icon = `<i class="fas fa-heart mr-2">`;
        this.wishlistButton.innerHTML = icon;
        this.enableButton();
    }

    enableButton() {
        this.wishlistButton.disabled = false;
    }

    disableButton() {
        this.wishlistButton.disabled = false;
    }

    updateId(newId) {
        this.wishlistButton.dataset.id = newId;
    }
}

export default AddToWishlist;
