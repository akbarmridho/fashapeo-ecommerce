class ConfirmAction {
    constructor() {
        this.links = document.querySelectorAll(".need-confirm");
        this.modalElement = document.getElementById("confirmModal");
        this.confirmModal = new window.mdb.Modal(this.modalElement);
    }

    initializeConfirmButton() {
        this.modalElement
            .getElementById("confirmAction")
            .addEventListener("click", () => {
                this.modalElement.dispatchEvent(
                    new CustomEvent("confirmAction", { confirm: true })
                );
            });
        this.modalElement
            .getElementById("cancelAction")
            .addEventListener("click", () => {
                this.modalElement.dispatchEvent(
                    new CustomEvent("confirmAction", { confirm: false })
                );
            });
    }

    initializeListener() {
        this.links.forEach(link => {
            link.addEventListener("click", this.performConfirm.bind(this));
        });
    }

    performConfirm(event) {
        this.confirmModal.show();
        const confirm = new Promise(resolve => {
            this.modalElement.addEventListener(
                "confirmAction",
                event => {
                    if (event.confirm) {
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                },
                {
                    once: true
                }
            );
            this.modalElement.addEventListener(
                "hide.mdb.modal",
                () => {
                    resolve(false);
                },
                { once: true }
            );
        });

        confirm.then(value => {
            if (value === false) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    }
}

module.exports = ConfirmAction;
