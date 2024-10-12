@push('styles')
    <style>
        .form-control:focus{
            border-color: #f82249;
            box-shadow: 0 0 0 0.25rem rgba(248, 34, 73, 0.25);
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(() => {
            $('#filters-trigger').on("click", function () {
                $('#filters-form').slideToggle();
            });
        });
    </script>
@endpush


