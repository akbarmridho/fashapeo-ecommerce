class Notification {
    constructor(element) {
        this.element = element;
        this.id = element.dataset.id;
        this.element.addEventListener("click", this.read.bind(this));
    }

    read() {
        window.axios.post(`/notification/${this.id}`, "").then((response) => {
            this.updateBackground();
        });
    }

    updateBackground() {
        this.element.classList.remove("bg-notification");
    }
}

export default Notification;
