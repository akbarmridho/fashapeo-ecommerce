@extends('layouts.admin')

@section('title')
Categories
@endsection

@section('additional-script')
<script src="{{ mix('/js/admin/categories.js') }}" defer></script>
@endsection

@section('content')

<div class="row">
    <h3 class="fw-bold">Categories</h3>
    <x-admin.session-alert />
    <div class="col-12 col-md-7">
        <table class="table table-bordered align-middle table-hover">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Parent Category</th>
            <th scope="col">Child Count</th>
            <th scope="col" style="width:100px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($categories->isEmpty())
            <td colspan="4"><h4>No Category found!</h4></td>
            @else
            @foreach($categories as $category)
            <tr>
            <th scope="row">{{ $category->name }}</th>
            <td>{{ $category->description }}</td>
            <td>
                @if($category->parent)
                    {{ $category->parent->name }}
                @else
                    None
                @endif
            </td>
            <td>{{ $category->children->count() }}</td>
            <td>
                <button 
                    class="btn btn-sm btn-info px-2 shadow-0"
                    id="editCategory"
                    data-mdb-toggle="modal"
                    data-mdb-target="#editCategoryModal"
                    data-category-id="{{ $category->id }}"
                ><i class="far fa-edit fa-lg"></i>
                </button>
                <button 
                    type="button"
                    id="deleteCategory"
                    class="btn btn-sm btn-danger text-white shadow-0 px-2"
                    data-category-id="{{ $category->id }}"
                    data-mdb-toggle="modal"
                    data-mdb-target="#deleteCategoryModal"
                    >
                    <i class="far fa-trash-alt fa-lg"></i>
                </button>
            </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        </table>
        @include('admin.modals.delete-category')
        @include('admin.modals.edit-category')
    </div>
    <div class="col-12 col-md-5">
        <h4>Create Category</h4>
        <x-admin.create-category :categories="$categories" />
    </div>
</div>

@endsection