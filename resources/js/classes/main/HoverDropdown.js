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

module.exports = HoverDropdown;
