document.addEventListener("DOMContentLoaded", function () {
    fetch("https://provinces.open-api.vn/api/")
        .then((response) => response.json())
        .then((data) => {
            let provinces = data;
            provinces.map(
                (value) =>
                    (document.getElementById(
                        "province"
                    ).innerHTML += `<option value="${value.code}">${value.name}</option>`)
            );
        })
        .catch((error) => {
            console.error("Lỗi khi gọi API:", error);
        });

    function fetchDistricts(provinceID) {
        fetch(`https://provinces.open-api.vn/api/p/${provinceID}?depth=2`)
            .then((response) => response.json())
            .then((data) => {
                let districts = data.districts;
                document.getElementById(
                    "district"
                ).innerHTML = `<option value="">Chọn quận/huyện</option>`;
                if (districts !== undefined) {
                    districts.map(
                        (value) =>
                            (document.getElementById(
                                "district"
                            ).innerHTML += `<option value="${value.code}">${value.name}</option>`)
                    );
                }
            })
            .catch((error) => {
                console.error("Lỗi khi gọi API:", error);
            });
    }

    function fetchWards(districtID) {
        fetch(`https://provinces.open-api.vn/api/d/${districtID}?depth=2`)
            .then((response) => response.json())
            .then((data) => {
                let wards = data.wards;
                document.getElementById(
                    "ward"
                ).innerHTML = `<option value="">Chọn phường/xã</option>`;
                if (wards !== undefined) {
                    wards.map(
                        (value) =>
                            (document.getElementById(
                                "ward"
                            ).innerHTML += `<option value="${value.code}">${value.name}</option>`)
                    );
                }
            })
            .catch((error) => {
                console.error("Lỗi khi gọi API:", error);
            });
    }

    window.getProvinces = function (event) {
        fetchDistricts(event.target.value);
        document.getElementById(
            "ward"
        ).innerHTML = `<option value="">Chọn phường/xã</option>`;
    };

    window.getDistricts = function (event) {
        fetchWards(event.target.value);
    };
});
