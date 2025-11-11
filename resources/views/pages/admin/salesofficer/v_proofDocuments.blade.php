@extends('layouts.dashboard')

@section('content')
<div class="page-content container-xxl">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            @component('components.card', [
                'title' => 'Proof and Documents Management',
                'cardtopAddButton' => false,
            ])

            @component('components.table', [
                'id' => 'proofDocumentsTable',
                'thead' => '
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total Items</th>
                    <th>Status</th>
                    <th>Proof of Delivery</th>
                    <th>Delivery Receipt</th>
                    <th>Sales Invoice</th>
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
        const table = $("#proofDocumentsTable").DataTable({
            processing: true,
            serverSide: true,
            paginationType: "simple_numbers",
            responsive: true,
            layout: {
                topEnd: {
                    search: {
                        placeholder: "Search Proofs and Documents",
                    },
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
            ajax: "{{ route('salesofficer.proof.documents.data') }}", // ✅ adjust route
            autoWidth: false,
            columns: [
                { data: "id", name: "id", width: "5%" },
                { data: "customer_name", name: "customer_name", width: "15%" },
                { data: "total_items", name: "total_items", width: "10%", orderable: false },
                { data: "status", name: "status", width: "10%", orderable: false },
                {
                    data: "proof_delivery",
                    name: "proof_delivery",
                    width: "10%",
                    
                },
                {
                    data: "delivery_receipt",
                    name: "delivery_receipt",
                    width: "10%",
                },
                {
                    data: "sales_invoice",
                    name: "sales_invoice",
                    width: "10%",
                }
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
