const Quill = require("quill");
const ImageUploader = require("quill-image-uploader");

Quill.register("modules/imageUploader", ImageUploader);

module.exports = Quill;
