class LocationSelection {
    constructor() {
        this.provinceInput = document.getElementById("province");
        this.cityInput = document.getElementById("city");
        this.vendorInput = document.getElementById("vendor");
        this.initializeProvince();
        this.counter = 0;
    }

    initializeCityListener() {
        this.provinceInput.addEventListener(
            "change",
            this.initializeCityHandler.bind(this)
        );
        this.cityInput.addEventListener(
            "change",
            this.modifyVendorId.bind(this)
        );
    }

    initializeCityHandler() {
        this.initializeCity(this.provinceInput.selectedOptions.dataset.id);
    }

    async initializeProvince() {
        let provinceData = await this.fetchProvinceData();

        if ((provinceData === false) & (this.counter < 4)) {
            this.initializeProvince();
            this.counter++;
            return;
        }

        this.addProvinceData(provinceData);
        this.provinceInput.dispatchEvent(new Event("ProvinceLoaded"));
        this.counter = 0;
        this.initializeCityListener();
    }

    async initializeCity(provinceId) {
        this.disableCityInput();

        let cityData = await this.fetchCityData(provinceId);

        if ((cityData === false) & (this.counter < 4)) {
            await this.initializeCity();
            this.counter++;
            return;
        }

        this.addCityData(cityData);
        this.cityInput.dispatchEvent(new Event("CityLoaded"));
        this.counter = 0;
    }

    modifyVendorId() {
        let selectedOption = this.cityInput.selectedOptions[0];
        this.vendorInput.value = selectedOption.dataset.id;
    }

    enableProvinceInput() {
        this.provinceInput.disabled = false;
    }

    enableCityInput() {
        this.cityInput.disabled = false;
    }

    disableCityInput() {
        this.cityInput.disabled = true;
    }

    async fetchProvinceData() {
        try {
            const { data: response } = await window.axios.get("/api/provinces");
            return response.results;
        } catch (error) {
            return false;
        }
    }

    async fetchCityData(provinceId) {
        try {
            const { data: response } = await window.axios.get(
                `/api/cities/?id=${provinceId}`
            );
            return response.results;
        } catch (error) {
            return false;
        }
    }

    addProvinceData(provinceData) {
        if (this.provinceInput.dataset.selected) {
            this.provinceInput.selectedOptions.forEach(element => {
                element.selected = false;
            });
        }

        provinceData.forEach(province => {
            let option = this.createProvinceOptionElement(province);
            this.provinceInput.append(option);
        });

        this.enableProvinceInput();
    }

    addCityData(cityData) {
        this.removeCityData();

        cityData.forEach(city => {
            let option = this.createCityOptionElement(city);
            this.cityInput.append(option);
        });

        this.enableCityInput();
    }

    createProvinceOptionElement(data) {
        let option = document.createElement("option");
        option.value = data.name;
        option.textContent = data.name;
        option.dataset.id = data.id;
        if (this.provinceInput.dataset.selected) {
            if (option.value === this.provinceInput.dataset.selected) {
                option.selected = true;
                this.initializeCity(data.id);
            }
        }
        return option;
    }

    createCityOptionElement(data) {
        let option = document.createElement("option");
        option.value = data.name;
        option.textContent = data.name;
        option.dataset.id = data.id;
        if (this.cityInput.dataset.selected) {
            if (option.value === this.cityInput.dataset.selected) {
                option.selected = true;
                this.vendorInput.value = data.id;
            }
        }
        return option;
    }

    removeCityData() {
        this.cityInput.innerHTML = `<option value="" selected disabled>Select city</option>`;
    }
}

export { LocationSelection };
