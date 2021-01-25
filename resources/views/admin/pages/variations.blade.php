@extends('layouts.admin')

@section('title')
Variations
@endsection

@section('additional-script')
<script src="{{ mix('/js/pages/admin/variations.js') }}" defer></script>
@endsection

@section('content')

<div class="row">
    <h3 class="fw-bold">Variations</h3>
    <x-admin.session-alert />
    <div class="col-12 col-md-7">
        <table class="table table-bordered align-middle table-hover">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Product Count</th>
            <th scope="col" style="width:100px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($variations->isEmpty())
            <td colspan="4"><h4>No Variation found!</h4></td>
            @else
            @foreach($variations as $variation)
            <tr>
            <th scope="row">{{ $variation->name }}</th>
            <td>{{ $variation->products_count }}</td>
            <td>
                <button 
                    class="btn btn-sm btn-info px-2 shadow-0"
                    id="editVariation"
                    data-mdb-toggle="modal"
                    data-mdb-target="#editVariationModal"
                    data-variation-id="{{ $variation->id }}"
                ><i class="far fa-edit fa-lg"></i>
                </button>
                <button 
                    type="button"
                    id="deleteVariation"
                    class="btn btn-sm btn-danger text-white shadow-0 px-2"
                    data-variation-id="{{ $variation->id }}"
                    data-mdb-toggle="modal"
                    data-mdb-target="#deleteVariationModal"
                    >
                    <i class="far fa-trash-alt fa-lg"></i>
                </button>
            </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        </table>
        @include('admin.modals.delete-variation')
        @include('admin.modals.edit-variation')
    </div>
    <div class="col-12 col-md-5">
        <h4>Create Variantion</h4>
        <x-admin.create-variation/>
    </div>
</div>

@endsection