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
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/dc4c0baezq9fir5yzl4mz7zy4jw5e7ffsoiwo2h4uk0j5d89/tinymce/7/tinymce.min.js"
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
            const checkboxTableItems = document.querySelectorAll(`.${checkboxItemClass}`);
            const selectedItems = document.querySelector("#selectedItems");
            const selectedIdsInput = document.getElementById('selectedIds');
            const actionButtons = document.getElementById('actionButtons');

            const updateSelectedItems = () => {
                const checkedItems = document.querySelectorAll(".table-item-checkbox:checked");
                const selectedIds = Array.from(checkedItems).map(item => item.value);
                selectedIdsInput.value = selectedIds.join(',');

                selectedItems.innerHTML = checkedItems.length ? `${checkedItems.length} mục được chọn` : "";
                checkboxTableAll.checked = checkedItems.length === checkboxTableItems.length;

                actionButtons.classList.toggle('hidden', checkedItems.length === 0);
                actionButtons.classList.toggle('flex', checkedItems.length > 0);
                actionButtons.classList.toggle('items-center', checkedItems.length > 0);
                actionButtons.classList.toggle('justify-start', checkedItems.length > 0);
            };

            checkboxTableAll.addEventListener("change", function () {
                checkboxTableItems.forEach((checkbox) => {
                    checkbox.checked = checkboxTableAll.checked;
                });
                updateSelectedItems();
            });

            checkboxTableItems.forEach((checkbox) => {
                checkbox.addEventListener("change", updateSelectedItems);
            });
        };
    </script>

    @livewireStyles
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

@livewireScripts
@yield('scripts')
@stack('scripts')
</body>

</html>
