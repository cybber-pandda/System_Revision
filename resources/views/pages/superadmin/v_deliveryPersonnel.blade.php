@extends('layouts.dashboard')

@section('content')
<div class="page-content container-xxl">

    @include('layouts.dashboard.breadcrumb')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            @component('components.card', [
            'title' => 'Delivery Personnel List',
            'cardtopAddButton' => false,
            ])

            @component('components.table', [
            'id' => 'deliveryPersonnelTable',
            'thead' => '
            <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Delivery Man</th>
                <th>Order Number</th>
                <th>Delivery Date & Time</th> <!-- new column -->
                <th>Total Amount</th>
                <th>Items</th>
                <th></th>
            </tr>
            '
            ])
            @endcomponent

            @endcomponent
        </div>
    </div>

    @component('components.modal', ['id' => 'assignDeliveryModal', 'size' => 'md', 'scrollable' => true])
    <form id="assignDeliveryForm" action="{{ route('tracking.assign-delivery-personnel') }}" method="POST">
    
        @component('components.select', [
            'label' => 'Delivery Man',
            'name' => 'delivery_rider_id',
            'selected' => old('delivery_rider_id', ''),
            'options' => $deliveryman_select->pluck('name', 'id')->toArray(),
            'attributes' => 'required'
        ])
        @endcomponent

        {{-- Date Time Picker --}}
        <div class="mb-3">
            <label for="delivery_datetime" class="form-label">Delivery Date & Time</label>
            <input type="text" id="delivery_datetime" name="delivery_datetime" class="form-control" required>
        </div>

    </form>
    @slot('footer')
    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary btn-sm" id="assignDeliverySubmit">
        <span class="assignDeliverySubmit_button_text">Assign</span>
        <span class="assignDeliverySubmit_load_data d-none">Loading <i class="loader"></i></span>
    </button>
    @endslot
    @endcomponent


</div>
@endsection

@push('scripts')
<script src="{{ route('secure.js', ['filename' => 'delivery_personnel']) }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#delivery_datetime", {
            enableTime: true,        // allow time selection
            time_24hr: true,         // 24-hour format
            enableSeconds: false,    // enable seconds if needed
            dateFormat: "Y-m-d H:i", // display format
            minDate: "today",        // prevent past dates
            defaultDate: new Date(),  // optional: prefill with current date & time
            allowInput: false        // prevent manual typing
        });
    });
</script>
@endpush
