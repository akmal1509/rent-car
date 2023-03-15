<div class="section-data-view mb-3">
    <a class="btn btn-primary mr-3" href="/admin/cars">
        All <span class="font-weight-bold">{{ ' (' . $tData . ')' }}</span>
    </a>
    <a class="btn btn-danger mr-3" href="/admin/cars/trashed">
        Trashed <span class="font-weight-bold">{{ ' (' . $tTrash . ')' }}</span>
    </a>

</div>

<div class="bulk-action d-flex align-items-center">
    <div class="form-group mr-3">
        <select class="form-control" name="bulk" id="bulk">
            <option value="">Bulk Action</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <button id="button-bulk" class="btn btn-light mr-3" onclick="bulkAction('Car','cars')" disabled>
        Apply
    </button>
</div>

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/admin/bulkAction.js') }}"></script>
@endpush
