@extends('layouts.admin')

@section('title')
Products
@endsection

@section('content')

<div class="row mx-3">

            <h3 class="fw-bold">Products</h3>
            <x-admin.session-alert />
 
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
              <li class="nav-item" role="presentation">
                <a
                  class="nav-link active"
                  id="ex1-tab-1"
                  data-mdb-toggle="tab"
                  href="#ex1-tabs-1"
                  role="tab"
                  aria-controls="ex1-tabs-1"
                  aria-selected="true"
                  >Active Products</a
                >
              </li>
              <li class="nav-item" role="presentation">
                <a
                  class="nav-link"
                  id="ex1-tab-2"
                  data-mdb-toggle="tab"
                  href="#ex1-tabs-2"
                  role="tab"
                  aria-controls="ex1-tabs-2"
                  aria-selected="false"
                  >Archived Products</a
                >
              </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
              <div
                class="tab-pane fade show active"
                id="ex1-tabs-1"
                role="tabpanel"
                aria-labelledby="ex1-tab-1"
              >
                {{-- <div class="col-12 col-md-6">
                  <div class="form-outline">
                    <input type="text" id="typeText" class="form-control" />
                    <label class="form-label" for="typeText">Text input</label>
                  </div>
                </div> --}}
                <div class="col-12 mt-3">
                  <x-admin.products-table :products="$products"/>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a
                          class="page-link"
                          href="#"
                          tabindex="-1"
                          aria-disabled="true"
                          >Previous</a
                        >
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="ex1-tabs-2"
                role="tabpanel"
                aria-labelledby="ex1-tab-2"
              >
                Tab 2 content
              </div>
            </div>
            <!-- Tabs content -->
          </div>

@endsection