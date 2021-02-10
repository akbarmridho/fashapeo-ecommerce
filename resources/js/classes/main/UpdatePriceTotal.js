class UpdatePriceTotal {
    constructor() {
        this.shipmentOptionInput = document.getElementById("shipmentOption");
        this.subtotal = parseInt(
            document.getElementById("subtotal").dataset.subtotal
        );
        this.shipmentCost = document.getElementById("shipmentCost");
        this.total = document.getElementById("orderTotal");
        this.shipmentOptionInput.addEventListener(
            "change",
            this.handleChange.bind(this)
        );
    }

    handleChange() {
        this.updateShipmentCost(this.getShipmentCost());
        this.updateOrderTotal(this.subtotal + this.getShipmentCost());
    }

    getShipmentCost() {
        return parseInt(
            this.shipmentOptionInput.selectedOptions[0].dataset.price
        );
    }

    updateShipmentCost(price) {
        this.shipmentCost.innerText = price;
    }

    updateOrderTotal(price) {
        this.total.innerText = price;
    }
}

export default UpdatePriceTotal;
