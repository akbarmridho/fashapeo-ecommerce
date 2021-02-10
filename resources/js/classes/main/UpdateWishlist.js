class UpdateWishlist {
    constructor(element) {
        this.element = element;
        this.wishlistButton = element.querySelector(".wishlist-button");
        this.initializer();
    }

    initializer() {
        this.getNotificationElement();
        this.initializeListener();
    }

    initializeListener() {
        this.wishlistButton.addEventListener("click", () => {
            this.removeFromWishlistHandler();
        });
    }

    getNotificationElement() {
        this.wishlistFailedNotification = document.getElementById(
            "wishlistFailed"
        );
        this.wishlistDeleteNotification = document.getElementById(
            "wishlistDelete"
        );
        this.initializeToast();
    }

    initializeToast() {
        this.wishlistFailed = new window.mdb.Toast(
            this.wishlistFailedNotification
        );
        this.wishlistDelete = new window.mdb.Toast(
            this.wishlistDeleteNotification
        );
    }

    removeFromWishlistHandler() {
        this.setAsLoading();
        window.axios
            .delete(`/wishlist/${this.getId()}`)
            .then((response) => {
                this.wishlistDelete.show();
                this.setAsNotAdded();
                this.removeElement();
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
        this.wishlistButton.dataset.state = "selected";
        this.enableButton();
    }

    enableButton() {
        this.wishlistButton.disabled = false;
    }

    disableButton() {
        this.wishlistButton.disabled = false;
    }

    removeElement() {
        this.element.remove();
    }
}

export default UpdateWishlist;
