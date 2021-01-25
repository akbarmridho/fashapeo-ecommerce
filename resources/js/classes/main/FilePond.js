const FilePond = require("filepond");
const FilePondPluginImageExifOrientation = require("filepond-plugin-image-exif-orientation");
const FilepondPluginFileRename = require("filepond-plugin-file-rename");
const FilePondPluginImageCrop = require("filepond-plugin-image-crop");
const FilePondPluginImagePreview = require("filepond-plugin-image-preview");
const FilePondPluginFileValidateSize = require("filepond-plugin-image-validate-size");
const FilePondPluginImageResize = require("filepond-plugin-image-resize");
const FilePondPluginImageTransform = require("filepond-plugin-image-transform");

FilePond.registerPlugin(
    FilePondPluginImageExifOrientation,
    FilePondPluginImageCrop,
    FilePondPluginImagePreview,
    FilePondPluginFileValidateSize,
    FilePondPluginImageResize,
    FilePondPluginImageTransform,
    FilepondPluginFileRename
);

module.exports = FilePond;
