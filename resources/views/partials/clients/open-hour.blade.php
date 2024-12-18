<div id="popup-open-hour"
    class="hidden inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal body -->
            <section class="overflow-hidden rounded-lg shadow-2xl md:grid md:grid-cols-3">
                <img alt="" src="https://www.stefroels.be/image/7dd89502ffacf96b964dfd504ef4153c.jpg"
                    class="h-32 w-full object-cover md:h-full" />

                <div class="p-4 text-center sm:p-6 md:col-span-2 lg:px-10 flex justify-center items-center">
                    <div>
                        <p class="font-semibold uppercase tracking-widest">Thông báo</p>
                        <span class="mt-2 block text-md font-bold">Hiện tại cửa hàng chưa mở cửa. Vui lòng đặt hàng
                            trong giờ mở cửa</span>
                        <p class="mt-6 mb-3 text-lg uppercase">Giờ mở cửa</p>
                        <div>
                            <span class="font-bold">Thứ Hai - Thứ Năm </span>: 10h sáng - 8h tối<br>
                            <span class="font-bold">Thứ Sáu</span>: 12h trưa - 12h tối <br>
                            <span class="font-bold">Thứ Bảy</span>: 11h sáng - 12h tối <br>
                            <span class="font-bold">Chủ Nhật</span>: 11h sáng - 10h tối
                        </div>
                        <span class="mt-2 block text-sm text-[#D30A0A]">
                            Lưu ý: Những đơn hàng được đặt ngoài giờ mở cửa sẽ được xử lý sau. Xin cảm ơn!
                        </span>
                        <div class="flex justify-center items-center my-5">
                            <button class="button-dark" onclick="closePopup()">
                                Xác nhận
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    async function showPopup() {
        const popupTimestamp = sessionStorage.getItem('popupTimestamp');
        console.log(popupTimestamp);
        const currentTime = new Date().getTime();

        // Kiểm tra nếu đã lưu thời gian và nó chưa quá 30 phút 
        if (!popupTimestamp || currentTime - popupTimestamp > 30 * 60 * 1000) {
            const response = await fetch('/api/is-open');
            const data = await response.json();
            if (!data.isOpen) {
                const modal = document.getElementById('popup-open-hour');
                modal.classList.add('fixed');
                modal.classList.remove('hidden');
            }
        }
    }

    function closePopup() {
        const modal = document.getElementById('popup-open-hour');
        modal.classList.add('hidden');
        modal.classList.remove('fixed');
        sessionStorage.setItem('popupTimestamp', new Date().getTime());
    }
    window.onload = showPopup;
</script>
