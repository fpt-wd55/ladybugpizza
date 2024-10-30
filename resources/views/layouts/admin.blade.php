<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- OpenSan --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    {{-- Dancing Script  --}}
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    {{-- Berkshire Swash --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Berkshire+Swash&family=Dancing+Script:wght@400..700&display=swap"
        rel="stylesheet">
    {{-- Vujahday Script --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Berkshire+Swash&family=Dancing+Script:wght@400..700&family=Vujahday+Script&display=swap"
        rel="stylesheet">
    {{-- ApexCharts Script --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/46tw1u77hj3s6r7nihhrey5e41ssxp7s4zwurwbiyk3ohblk/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#wysiwygeditor',
            language: 'vi',
            menubar: false,
            statusbar: false,
            plugins: 'fullscreen lists link image code',
            toolbar: 'undo redo | blocks | bold italic underline strikethrough removeformat link image code | alignleft aligncenter alignright | bullist numlist | fullscreen'
        });

        function tableCheckboxItem(checkboxAllId, checkboxItemClass) {
            const checkboxTableAll = document.getElementById(checkboxAllId);
            const checkboxTableItem = document.querySelectorAll(
                `.${checkboxItemClass}`
            );
            const selectedItems = document.querySelector("#selectedItems");

            const updateSelectedItems = () => {
                const checkedItems = document.querySelectorAll(
                    ".table-item-checkbox:checked"
                ).length;
                selectedItems.textContent = checkedItems ?
                    `${checkedItems} mục được chọn` :
                    "";
                checkboxTableAll.checked = checkedItems === checkboxTableItem.length;
            };

            checkboxTableAll.addEventListener("change", function() {
                checkboxTableItem.forEach((checkbox) => {
                    checkbox.checked = checkboxTableAll.checked;
                });
                updateSelectedItems();
            });

            checkboxTableItem.forEach((checkbox) => {
                checkbox.addEventListener("change", updateSelectedItems);
            });
        };
    </script>
</head>

<body class="text-sm">
    {{-- header --}}
    @include('partials.admins.header')
    <div>
        {{-- sidebar --}}
        @include('partials.admins.sidebar')

        <div class="mt-20 sm:ml-64">
            <div class="px-4">
                {{-- Toast notification --}}
                @include('partials.admins.toast-notification')
                {{-- Content --}}
                <div class="m-0 p-0">
                    @yield('content')
                    {{-- footer --}}
                    @include('partials.admins.footer')
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
