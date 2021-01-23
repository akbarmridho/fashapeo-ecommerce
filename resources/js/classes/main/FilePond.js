import * as FilePond from "filepond";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import FilepondPluginFileRename from "filepond-plugin-file-rename";
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginFileValidateSize from "filepond-plugin-image-validate-size";
import FilePondPluginImageResize from "filepond-plugin-image-resize";
import FilePondPluginImageTransform from "filepond-plugin-image-transform";

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
