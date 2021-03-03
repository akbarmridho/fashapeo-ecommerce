import { CarouselImage } from "../../config/Filepond";

const { CarouselImage } = require("../../config/Filepond");

document.addEventListener("DOMContentLoaded", () => {
    window.FilePond.create(document.querySelector(".filepond"), CarouselImage);
});
