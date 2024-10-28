import "./bootstrap";
import "flowbite";
import "./charts";
import "./fslightbox";
import search from "./search";

search.start();

import {
    getProvinces,
    getDistrictsByProvince,
    getWardsByDistrict,
    getAddressNamesByCodes,
} from "./getLocation";

document.addEventListener("DOMContentLoaded", function () {
    const provinceSelect = document.getElementById("province");
    const districtSelect = document.getElementById("district");
    const wardSelect = document.getElementById("ward");

    function renderProvinces() {
        const provinces = getProvinces();
        provinces.forEach((province) => {
            const option = document.createElement("option");
            option.value = province.id;
            option.text = province.name;
            provinceSelect.appendChild(option);
        });
    }

    provinceSelect.addEventListener("change", function () {
        const provinceId = provinceSelect.value;
        const districts = getDistrictsByProvince(provinceId);
        districtSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';
        wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
        districts.forEach((district) => {
            const option = document.createElement("option");
            option.value = district.id;
            option.text = district.name;
            districtSelect.appendChild(option);
        });
    });

    districtSelect.addEventListener("change", function () {
        const districtId = districtSelect.value;
        const wards = getWardsByDistrict(districtId);
        wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
        wards.forEach((ward) => {
            const option = document.createElement("option");
            option.value = ward.id;
            option.text = ward.name;
            wardSelect.appendChild(option);
        });
    });

    const addressNames = getAddressNamesByCodes(
        addressCodes.province,
        addressCodes.district,
        addressCodes.ward
    );

    renderProvinces();
});
