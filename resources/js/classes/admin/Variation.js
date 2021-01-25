class Variation {
    constructor() {
        this.table = document.querySelector("tbody");
        this.confirmDeleteBtn = document.getElementById("confirmDelete");
        this.deleteVariationModalElement = document.getElementById(
            "deleteVariationModal"
        );
        this.editVariationModalElement = document.getElementById(
            "editVariationModal"
        );
        this.deleteVariationModal = new window.mdb.Modal(
            this.deleteVariationModalElement
        );
        this.editVariationModal = new window.mdb.Modal(
            this.editVariationModalElement
        );
        this.editVariationModalContent = document.getElementById(
            "editVariationModalContent"
        );
        this.oldEditVariationModalContent = this.editVariationModalContent.cloneNode(
            true
        );
        this.tableListener();
        this.modalHideListener();
    }

    tableListener() {
        this.table.addEventListener("click", event => {
            actionButton = event.target.closest("button");

            if (actionButton === null) {
                return;
            }

            if (actionButton.id === "deleteVariation") {
                variationId = actionButton.dataset.variationId;
                this.deleteListener(variationId);
            }

            if (actionButton.id === "editVariation") {
                variationId = actionButton.dataset.variationId;
                this.performEdit(variationId);
            }
        });
    }

    modalHideListener() {
        this.editVariationModalElement.addEventListener(
            "hide.mdb.modal",
            this.clearEditModal.bind(this)
        );
        this.deleteVariationModalElement.addEventListener(
            "hide.mdb.modal",
            this.clearDeleteListener.bind(this)
        );
    }

    deleteListener(variationId) {
        this.confirmDeleteBtn.addEventListener(
            "click",
            this.performDelete.bind(this, variationId)
        );
    }

    performDelete(variationId) {
        window.axios
            .delete(`/admin/variants/${variationId}`)
            .then(response => {
                this.clearDeleteListener();
                location.reload();
            })
            .catch(error => {
                this.deleteVariationModal.hide();
                alert("Something went wrong!");
            });
    }

    performEdit(variationId) {
        window.axios
            .get(`/admin/variants/${variationId}`)
            .then(response => {
                this.editVariationModalContent.innerHTML = response.data;
                this.initializeInput();
            })
            .catch(error => {
                this.editVariationModalContent.innerHTML =
                    '<div class="text-center p-5><h3 class="text-danger">Something went wrong</h3></div>';
            });
    }

    initializeInput() {
        this.editVariationModalContent
            .querySelectorAll(".form-outline")
            .forEach(formOutline => {
                new mdb.Input(formOutline).init();
            });
    }

    clearDeleteListener() {
        this.confirmDeleteBtn = this.confirmDeleteBtn.cloneNode(true);
    }

    clearEditModal() {
        this.editVariationModalContent = this.oldEditVariationModalContent.cloneNode(
            true
        );
    }
}

module.exports = Variation;
