class LocationSelection {
    constructor() {
        this.provinceInput = document.getElementById("province");
        this.cityInput = document.getElementById("city");
        window.addEventListener(
            "DOMContentLoaded",
            this.initializeProvince.bind(this)
        );
        this.provinceInput.addEventListener(
            "change",
            this.initializeCity.bind(this)
        );
    }

    async initializeProvince() {
        let provinceData = await this.fetchProvinceData();

        if (provinceData === false) {
            this.initializeProvince();
            return;
        }

        this.addProvinceData(provinceData);
    }

    async initializeCity() {
        this.disableCityInput();

        let cityData = await this.fetchCityData();

        if (cityData === false) {
            this.initializeCity();
            return;
        }

        this.addCityData(this.sortedCityData(cityData));
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
        this.provinceData;
        try {
            const { data: response } = await window.axios.get("/api/provinces");
            return response;
        } catch (error) {
            console.log(error);
            return false;
        }
    }

    async fetchCityData() {
        try {
            let provinceId = await this.provinceInput.value;
            const { data: response } = await window.axios.get(
                `/api/cities/${provinceId}`
            );
            return response;
        } catch (error) {
            console.log(error);
            return false;
        }
    }

    addProvinceData(provinceData) {
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
        option.value = data.province_id;
        option.textContent = data.province;
        return option;
    }

    createCityOptionElement(data) {
        let option = document.createElement("option");
        option.value = data.city_id;
        option.textContent = data.type + " " + data.city_name;
        return option;
    }

    removeCityData() {
        this.cityInput.innerHTML = `<option value="" disabled selected>Select city</option>`;
    }

    sortedCityData(cityData) {
        cityData = cityData.sort(function(a, b) {
            if (a.type < b.type) {
                return 1;
            }
            return -1;
        });

        cityData = cityData.sort(function(a, b) {
            if (a.type === b.type) {
                if (a.city_name < b.city_name) {
                    return -1;
                }
                return 1;
            }
            return 0;
        });

        return cityData;
    }
}

new LocationSelection();
