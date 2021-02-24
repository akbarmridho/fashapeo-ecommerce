class ReadAllNotification {
    constructor(element) {
        this.element = element;
        this.done = false;
        this.element.addEventListener("click", this.handler.bind(this));
    }

    // change visual for every notification element

    handler() {
        if (this.done) {
            return;
        }

        window.axios.post("/notification", "").then((response) => {
            this.done = true;
        });
    }
}

export default ReadAllNotification;
