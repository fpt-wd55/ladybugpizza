import './bootstrap'
import 'flowbite'
import './charts'
import './fetchLocation'
import search from './search'

search.start()


// Hướng dẫn sử dụng fetch province api

// view

{/* 
    <select id="province" onchange="getProvinces(event)">
        <option value="">Chọn tỉnh/thành</option>
    </select>
    
    <select id="district" onchange="getDistricts(event)">
        <option value="">Chọn quận/huyện</option>
    </select>

    <select id="ward">
        <option value="">Chọn phường/xã</option>
    </select> 
*/}


// script

// document.addEventListener("DOMContentLoaded", function () {
//     // Lấy danh sách các tỉnh và thêm vào select
//     fetchProvinces().then((data) => {
//         let provinces = data;
//         let provinceSelect = document.getElementById("province");
//         provinces.forEach((value) => {
//             let option = document.createElement("option");
//             option.value = value.code;
//             option.text = value.name;
//             provinceSelect.appendChild(option);
//         });
//     });

//     // Khi chọn tỉnh, lấy danh sách quận/huyện
//     window.getProvinces = function (event) {
//         let provinceID = event.target.value;
//         fetchDistricts(provinceID).then((data) => {
//             let districts = data.districts;
//             let districtSelect = document.getElementById("district");
//             districtSelect.innerHTML = `<option value="">Chọn quận/huyện</option>`;
//             districts.forEach((value) => {
//                 let option = document.createElement("option");
//                 option.value = value.code;
//                 option.text = value.name;
//                 districtSelect.appendChild(option);
//             });
//         });
        
//         // Reset lại danh sách phường/xã
//         document.getElementById("ward").innerHTML = `<option value="">Chọn phường/xã</option>`;
//     };

//     // Khi chọn quận/huyện, lấy danh sách phường/xã
//     window.getDistricts = function (event) {
//         let districtID = event.target.value;
//         fetchWards(districtID).then((data) => {
//             let wards = data.wards;
//             let wardSelect = document.getElementById("ward");
//             wardSelect.innerHTML = `<option value="">Chọn phường/xã</option>`;
//             wards.forEach((value) => {
//                 let option = document.createElement("option");
//                 option.value = value.code;
//                 option.text = value.name;
//                 wardSelect.appendChild(option);
//             });
//         });
//     };
// });
