class Category {
    constructor() {
        this.table = document.querySelector("tbody");
        this.confirmDeleteBtn = document.getElementById("confirmDelete");
        this.deleteCategoryModalElement = document.getElementById(
            "deleteCategoryModal"
        );
        this.editCategoryModalElement = document.getElementById(
            "editCategoryModal"
        );
        this.deleteCategoryModal = new mdb.Modal(
            this.deleteCategoryModalElement
        );
        this.editCategoryModal = new mdb.Modal(this.editCategoryModalElement);
        this.editCategoryModalContent = document.getElementById(
            "editCategoryModalContent"
        );
        this.oldEditCategoryModalContent = this.editCategoryModalContent.cloneNode(
            true
        );
        this.tableListener();
        this.modalHideListener();
    }

    tableListener() {
        this.table.addEventListener("click", event => {
            actionButton = event.target.closest("button");

            if (actionButton.id === "deleteCategory") {
                categoryId = actionButton.dataset.categoryId;
                this.deleteListener(categoryId);
            }

            if (actionButton.id === "editCategory") {
                categoryId = actionButton.dataset.categoryId;
                this.performEdit(categoryId);
            }
        });
    }

    modalHideListener() {
        this.editCategoryModalElement.addEventListener(
            "hide.mdb.modal",
            this.clearEditModal.bind(this)
        );
        this.deleteCategoryModalElement.addEventListener(
            "hide.mdb.modal",
            this.clearDeleteListener.bind(this)
        );
    }

    deleteListener(categoryId) {
        this.confirmDeleteBtn.addEventListener(
            "click",
            this.performDelete.bind(this, categoryId)
        );
    }

    performDelete(categoryId) {
        window.axios
            .delete(`/admin/categories/${categoryId}`)
            .then(response => {
                this.clearDeleteListener();
                location.reload();
            })
            .catch(error => {
                this.deleteCategoryModal.hide();
                alert("Something went wrong!");
            });
    }

    performEdit(categoryId) {
        window.axios
            .get(`/admin/categories/${categoryId}`)
            .then(response => {
                this.editCategoryModalContent.innerHTML = response.data;
                this.initializeInput();
            })
            .catch(error => {
                this.editCategoryModalContent.innerHTML =
                    '<div class="text-center p-5><h3 class="text-danger">Something went wrong</h3></div>';
            });
    }

    initializeInput() {
        this.editCategoryModalContent
            .querySelectorAll(".form-outline")
            .forEach(formOutline => {
                new mdb.Input(formOutline).init();
            });
    }

    clearDeleteListener() {
        this.confirmDeleteBtn = this.confirmDeleteBtn.cloneNode(true);
    }

    clearEditModal() {
        this.editCategoryModalContent = this.oldEditCategoryModalContent.cloneNode(
            true
        );
    }
}

module.exports = Category;
