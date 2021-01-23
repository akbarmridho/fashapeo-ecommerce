class AdminSideNavigation {
    constructor() {
        this.sidenav = document.getElementById("admin-sidenav");
        this.sidenavButton = document.getElementById("sidenavCollapse");
        this.content = document.getElementById("content");
        this.initializer();
    }

    initializer() {
        this.sidenavListener();
    }

    sidenavListener() {
        this.sidenavButton.addEventListener(
            "click",
            this.toggleActive.bind(this)
        );
    }

    toggleActive(event) {
        event.stopPropagation();
        this.sidenav.classList.toggle("active");
        this.content.classList.toggle("active");
    }
}

module.exports = AdminSideNavigation;
