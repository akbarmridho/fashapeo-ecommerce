class ConfirmAction {
    constructor() {
        this.links = document.querySelectorAll(".need-confirm");
        this.modalElement = document.getElementById("confirmModal");
        this.initialize();
    }

    initialize() {
        if (this.links.length == 0 || !this.modalElement) {
            return;
        }
        this.confirmModal = new window.mdb.Modal(this.modalElement);
        this.initializeConfirmButton();
        this.initializeListener();
    }

    initializeConfirmButton() {
        document
            .getElementById("confirmAction")
            .addEventListener("click", () => {
                this.modalElement.dispatchEvent(
                    new CustomEvent("confirmAction", {
                        detail: { confirm: true }
                    })
                );
            });
        document
            .getElementById("cancelAction")
            .addEventListener("click", () => {
                this.modalElement.dispatchEvent(
                    new CustomEvent("confirmAction", {
                        detail: { confirm: false }
                    })
                );
            });
    }

    initializeListener() {
        this.links.forEach(link => {
            link.addEventListener(
                "click",
                this.performConfirm.bind(this, link)
            );
        });
    }

    async performConfirm(link, event) {
        this.confirmModal.show();
        // let newEvent = new event.constructor(event.type, event);
        event.preventDefault();
        event.stopPropagation();
        const confirm = await new Promise(resolve => {
            this.modalElement.addEventListener(
                "confirmAction",
                ev => {
                    if (ev.detail.confirm) {
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
        if ((await confirm) === true) {
            // link.removeEventListener(
            //     "click",
            //     this.performConfirm.bind(this, link)
            // );
            event.target.closest("form").submit();
            // event.target.dispatchEvent(newEvent);
        }
    }
}

export { ConfirmAction };
