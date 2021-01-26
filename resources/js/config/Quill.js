const config = {
    modules: {
        toolbar: [
            ["bold", "italic", "underline", "strike"],
            ["blockquote", "code-block"],
            ["image"],

            [{ header: 1 }, { header: 2 }],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ script: "sub" }, { script: "super" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ direction: "rtl" }],

            [{ size: ["small", false, "large", "huge"] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],

            [{ color: [] }, { background: [] }],
            [{ font: [] }],
            [{ align: [] }],

            ["clean"]
        ],
        imageUploader: {
            upload: async file => {
                const data = new FormData();
                data.append("image", file);
                return await window.axios
                    .post("/api/image/upload", data, {
                        headers: {
                            "content-type": "multipart/form-data"
                        }
                    })
                    .then(response => {
                        return response.data;
                    });
            }
        }
    },
    theme: "snow"
};

export { config };
