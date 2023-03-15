@extends('layouts.admin.app')

@section('title', 'Create Car')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Car</h1>
            </div>

            <div class="section-body">
                <form method="post" action="/admin/cars" enctype="multipart/form-data">
                    @csrf
                    @include('components.admin.forms._formCar')
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('js/admin/slugChecker.js') }}"></script>
    <script src="{{ asset('js/admin/removeInvalid.js') }}"></script>

    <script>
        var cleaveC = new Cleave(".currency", {
            numeral: true,
            numeralThousandsGroupStyle: "thousand",
        });
    </script>
@endpush
