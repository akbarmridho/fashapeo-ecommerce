const config = {
    UploadProductImage: {
        maxFileSize: "3MB",
        maxFiles: 1,
        stylePanelLayout: "compact",
        allowMultiple: false,
        required: false,
        stylePanelAspectRatio: 1,
        styleItemPanelAspectRatio: 1,
        imageCropAspectRatio: 1,
        credits: null,
        labelIdle:
            "<span class='filepond--label-action'><i class='fas fa-plus p-0 m-0'></i></span>",
        imageResizeTargetWidth: 1024,
        imageTransformVariants: {
            thumb_medium_: transforms => {
                transforms.resize.size.width = 384;
                return transforms;
            },
            thumb_small_: transforms => {
                transforms.resize.size.width = 128;
                return transforms;
            }
        }
    },

    UploadMasterProductImage: {
        allowReorder: true,
        maxFileSize: "3MB",
        maxFiles: 5,
        allowMultiple: true,
        required: true,
        itemInsertLocation: "after",
        styleItemPanelAspectRatio: 1,
        imageCropAspectRatio: 1,
        imageResizeTargetWidth: 1024,
        imageTransformVariants: {
            thumb_medium_: transforms => {
                transforms.resize.size.width = 384;
                return transforms;
            },
            thumb_small_: transforms => {
                transforms.resize.size.width = 128;
                return transforms;
            }
        }
    }
};

module.exports = config;
