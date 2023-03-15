@extends('layouts.admin.app')

@section('title', 'Edit Car')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Car</h1>
            </div>

            <div class="section-body">
                <form method="post" action="/admin/cars/{{ $car->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('components.admin.forms._formCar')
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('js/admin/slugChecker.js') }}"></script>

    <script>
        var cleaveC = new Cleave(".currency", {
            numeral: true,
            numeralThousandsGroupStyle: "thousand",
        });
    </script>
@endpush
