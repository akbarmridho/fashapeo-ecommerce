<div class="bg-image">
    {{-- <img src="/img/category3.jpg" alt="" class="img-fluid"> --}}
    <div style="min-height: 250px"></div>
    <div class="mask d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.6)">
        <div class="py-3 px-5">
            <h1 class="display-4 fw-bold text-white uppercase">{{ strtoupper($category->name) }}</h1>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Categories</li>
                <x-main.categories-breadcrumb :categories="$categories" :category="$category->id" />
            </ol>
        </nav>
    </div>
</nav>
