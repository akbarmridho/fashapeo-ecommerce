const UploadProductImage = {
    server: {
        process: {
            url: "/api/image/process",
            ondata: formData => {
                let newData = new FormData();
                for (let value of formData.values()) {
                    if (value instanceof File) {
                        newData.append("image", value);
                    }
                }
                return newData;
            }
        },
        revert: "/api/image/delete",
        restore: null,
        load: "/api/image?type=product&load=",
        fetch: null
    },
    maxFileSize: "3MB",
    maxFiles: 1,
    stylePanelLayout: "compact",
    allowMultiple: false,
    required: false,
    stylePanelAspectRatio: 1,
    styleItemPanelAspectRatio: 1,
    imageCropAspectRatio: 1,
    credits: false,
    labelIdle:
        "<span class='filepond--label-action'><i class='fas fa-plus p-0 m-0'></i></span>",
    imageResizeTargetWidth: 1024
    // imageTransformVariants: {
    //     thumb_medium_: transforms => {
    //         transforms.resize.size.width = 384;
    //         return transforms;
    //     },
    //     thumb_small_: transforms => {
    //         transforms.resize.size.width = 128;
    //         return transforms;
    //     }
    // },
    // fileRenameFunction: file => {
    //     return stringGenerator(40) + file.extension;
    // }
};

const UploadMasterProductImage = {
    server: {
        process: {
            url: "/api/image/process",
            ondata: formData => {
                let newData = new FormData();
                for (let value of formData.values()) {
                    if (value instanceof File) {
                        newData.append("image", value);
                    }
                }
                return newData;
            }
        },
        revert: "/api/image/delete",
        restore: null,
        load: "/api/image?type=product&load=",
        fetch: null
    },
    allowReorder: true,
    maxFileSize: "3MB",
    maxFiles: 5,
    allowMultiple: true,
    required: true,
    itemInsertLocation: "after",
    styleItemPanelAspectRatio: 1,
    imageCropAspectRatio: 1,
    imageResizeTargetWidth: 1024
    // imageTransformVariants: {
    //     thumb_medium_: transforms => {
    //         transforms.resize.size.width = 384;
    //         return transforms;
    //     },
    //     thumb_small_: transforms => {
    //         transforms.resize.size.width = 128;
    //         return transforms;
    //     }
    // },
    // fileRenameFunction: file => {
    //     return stringGenerator(40) + file.extension;
    // }
};

function dec2hex(dec) {
    return dec.toString(16).padStart(2, "0");
}

const stringGenerator = len => {
    var arr = new Uint8Array((len || 40) / 2);
    window.crypto.getRandomValues(arr);
    return Array.from(arr, dec2hex).join("");
};

export { UploadMasterProductImage, UploadProductImage };
