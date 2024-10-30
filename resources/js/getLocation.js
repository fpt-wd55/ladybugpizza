import dvhcvn from 'dvhcvn';

export function getProvinces() {
    return dvhcvn.level1s;
}

export function getDistrictsByProvince(provinceId) {
    const province = dvhcvn.findById(provinceId);
    return province ? province.children : [];
} 

export function getWardsByDistrict(districtId) {
    const district = dvhcvn.findById(districtId);
    return district ? district.children : [];
}

export function getAddressNamesByCodes(provinceCode, districtCode, wardCode) {
    const province = dvhcvn.findLevel1ById(provinceCode);
    const provinceName = province ? province.name : null;

    const district = province ? province.findLevel2ById(districtCode) : null;
    const districtName = district ? district.name : null;

    const ward = district ? district.findLevel3ById(wardCode) : null;
    const wardName = ward ? ward.name : null;

    return {
        province: provinceName,
        district: districtName,
        ward: wardName,
    };
}
