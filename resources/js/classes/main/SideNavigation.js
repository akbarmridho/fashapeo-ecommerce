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

module.exports = SideNavigation;
