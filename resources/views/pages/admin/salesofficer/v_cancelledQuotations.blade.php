@extends('layouts.dashboard')

@section('content')
<div class="page-content container-xxl">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            @component('components.card', [
                'title' => 'Cancelled Quotation List',
                'cardtopAddButton' => false,
            ])

            @component('components.table', [
                'id' => 'cancelledQuotationTable',
                'thead' => '
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total Items</th>
                    <th>Grand Total</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>Reason for Cancellation</th>
                </tr>
                '
            ])
            @endcomponent

            @endcomponent
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const table = $("#cancelledQuotationTable").DataTable({
            processing: true,
            serverSide: true,
            paginationType: "simple_numbers",
            responsive: true,
            layout: {
                topEnd: {
                    search: { placeholder: "Search Cancelled Quotations" },
                },
            },
            aLengthMenu: [
                [5, 10, 30, 50, -1],
                [5, 10, 30, 50, "All"],
            ],
            iDisplayLength: 10,
            language: { search: "Search:" },
            fixedHeader: { header: true },
            scrollCollapse: true,
            scrollX: true,
            scrollY: 600,
            ajax: "/salesofficer/cancelled-quotations/all",
            autoWidth: false,
            columns: [
                { data: "id", name: "id", width: "5%" },
                { data: "customer_name", name: "customer_name", width: "20%" },
                { data: "total_items", name: "total_items", width: "10%" },
                { data: "grand_total", name: "grand_total", width: "10%" },
                { data: "created_at", name: "created_at", width: "15%" },
                { data: "status", name: "status", width: "15%" },
                { data: "cancel_reason", name: "cancel_reason", width: "25%" },
            ],
            drawCallback: function () {
                if (typeof lucide !== "undefined") {
                    lucide.createIcons();
                }
            },
        });
    });
</script>
@endpush
