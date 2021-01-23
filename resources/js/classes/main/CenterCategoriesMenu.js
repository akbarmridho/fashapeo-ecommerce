class CenterCategoriesMenu {
    constructor() {
        this.categoriesMenu = document.getElementById("categoriesMenu");
        this.setCenter();
    }

    retreiveParentWidth() {
        return this.categoriesMenu.previousElementSibling.offsetWidth;
    }

    retreiveCategoriesWidth() {
        let cloned = categoriesMenu.cloneNode(true);
        cloned.style.left = 10000;
        cloned.style.display = "block";
        document.querySelector("body").append(cloned);
        const categoriesWidth = cloned.offsetWidth;
        cloned.remove();

        return categoriesWidth;
    }

    calculatePos() {
        return (
            (this.retreiveCategoriesWidth() - this.retreiveParentWidth()) / 2
        );
    }

    setCenter() {
        this.categoriesMenu.style.left = `-${this.calculatePos()}px`;
    }
}

module.exports = CenterCategoriesMenu;
