// const { drop } = require("lodash");

// Hover dropdown
class HoverDropdown {
    constructor() {
        this.dropdownElementList = document.querySelectorAll("#navbarDropdown");
        this.initialize();
    }

    initialize() {
        this.dropdownElementList.forEach(element => {
            const dropdown = new mdb.Dropdown(element);
            element.parentElement.addEventListener(
                "mouseenter",
                dropdown.show.bind(dropdown)
            );
            element.parentElement.addEventListener(
                "mouseleave",
                dropdown.hide.bind(dropdown)
            );
        });
    }
}

class SideNavigation {
    constructor() {
        this.sidenav = document.getElementById("sidenav");
        this.sidenavButton = document.getElementById("sidenavCollapse");
        this.overlay = document.querySelector(".sidenav-overlay");
        this.initializer();
    }

    initializer() {
        this.showSidenav();
        this.hideSidenav();
    }

    showSidenav() {
        this.sidenavButton.addEventListener(
            "click",
            this.toggleActive.bind(this)
        );
    }

    hideSidenav() {
        this.overlay.addEventListener("click", this.toggleActive.bind(this));
    }

    toggleActive() {
        this.sidenav.classList.toggle("active");
        this.overlay.classList.toggle("active");
    }
}

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

new HoverDropdown();
new SideNavigation();
new CenterCategoriesMenu();
