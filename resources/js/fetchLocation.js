const apiUrl = "https://provinces.open-api.vn/api";

function fetchProvinces() {
    return fetch(apiUrl)
        .then((response) => response.json())
        .catch((error) => {
            console.error("Lỗi khi gọi API tỉnh:", error);
        });
}

function fetchDistricts(provinceID) {
    return fetch(`${apiUrl}/p/${provinceID}?depth=2`)
        .then((response) => response.json())
        .catch((error) => {
            console.error("Lỗi khi gọi API quận/huyện:", error);
        });
}

function fetchWards(districtID) {
    return fetch(`${apiUrl}/d/${districtID}?depth=2`)
        .then((response) => response.json())
        .catch((error) => {
            console.error("Lỗi khi gọi API phường/xã:", error);
        });
}

export { fetchProvinces, fetchDistricts, fetchWards };
