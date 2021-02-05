class AddToWishlist {
    constructor() {
        this.wishlistButton = document.getElementById("wishlist");
    }

    initializer() {
        this.getNotificationElement();
    }

    initializeListener() {
        this.wishlistButton.addEventListener("click", () => {
            //
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
        //
    }

    removeFromWishlistHandler() {
        //
    }

    setAsNotAdded() {
        //
    }

    setAsAdded() {
        //
    }
}

export default AddToWishlist;
