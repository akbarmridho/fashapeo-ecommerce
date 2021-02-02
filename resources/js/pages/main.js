const CenterCategoriesMenu = require("../classes/main/CenterCategoriesMenu");
const HoverDropdown = require("../classes/main/HoverDropdown");
const SideNavigation = require("../classes/main/SideNavigation");
const { ConfirmAction } = require("../classes/main/ConfirmAction");

document.addEventListener("DOMContentLoaded", () => {
    new CenterCategoriesMenu();
    new HoverDropdown();
    new SideNavigation();
    new ConfirmAction();
});
