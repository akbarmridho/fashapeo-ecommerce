@extends('layouts.main')
@section('title')
    Single Page
@endsection
@section('content')
    <main>
        <!-- Carousel wrapper -->
        @include('main.includes.single-page-header')
        <!-- Carousel wrapper -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9">
                    <!-- Spied element -->
                    <div data-mdb-spy="scroll" data-mdb-target="#scrollspy" data-mdb-offset="0" class="scrollspy-example"
                        style="position: relative; overflow-y: auto;">
                        <section id="example-1">
                            <h3>Section 1</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit. Labore earum natus vel minima quod error maxime,
                                molestias ut. Fuga dignissimos nisi nemo necessitatibus
                                quisquam obcaecati et reiciendis quaerat accusamus
                                numquam. Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Labore earum natus vel minima quod
                                error maxime, molestias ut. Fuga dignissimos nisi nemo
                                necessitatibus quisquam obcaecati et reiciendis quaerat
                                accusamus numquam.</p>
                        </section>
                        <section id="example-2">
                            <h3>Section 2</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit. Labore earum natus vel minima quod error maxime,
                                molestias ut. Fuga dignissimos nisi nemo necessitatibus
                                quisquam obcaecati et reiciendis quaerat accusamus
                                numquam. Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Labore earum natus vel minima quod
                                error maxime, molestias ut. Fuga dignissimos nisi nemo
                                necessitatibus quisquam obcaecati et reiciendis quaerat
                                accusamus numquam.</p>
                        </section>
                        <section id="example-3">
                            <h3>Section 3</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit. Labore earum natus vel minima quod error maxime,
                                molestias ut. Fuga dignissimos nisi nemo necessitatibus
                                quisquam obcaecati et reiciendis quaerat accusamus
                                numquam. Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Labore earum natus vel minima quod
                                error maxime, molestias ut. Fuga dignissimos nisi nemo
                                necessitatibus quisquam obcaecati et reiciendis quaerat
                                accusamus numquam.</p>
                            <section id="example-sub-A">
                                <h3>Subsection A</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. Labore earum natus vel minima quod error maxime,
                                    molestias ut. Fuga dignissimos nisi nemo necessitatibus
                                    quisquam obcaecati et reiciendis quaerat accusamus
                                    numquam. Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore earum natus vel minima quod
                                    error maxime, molestias ut. Fuga dignissimos nisi nemo
                                    necessitatibus quisquam obcaecati et reiciendis quaerat
                                    accusamus numquam.</p>
                            </section>
                            <section id="example-sub-B">
                                <h3>Subsection B</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. Labore earum natus vel minima quod error maxime,
                                    molestias ut. Fuga dignissimos nisi nemo necessitatibus
                                    quisquam obcaecati et reiciendis quaerat accusamus
                                    numquam. Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Labore earum natus vel minima quod
                                    error maxime, molestias ut. Fuga dignissimos nisi nemo
                                    necessitatibus quisquam obcaecati et reiciendis quaerat
                                    accusamus numquam.</p>
                            </section>
                        </section>
                        <section id="example-4">
                            <h3>Section 4</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit. Labore earum natus vel minima quod error maxime,
                                molestias ut. Fuga dignissimos nisi nemo necessitatibus
                                quisquam obcaecati et reiciendis quaerat accusamus
                                numquam. Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Labore earum natus vel minima quod
                                error maxime, molestias ut. Fuga dignissimos nisi nemo
                                necessitatibus quisquam obcaecati et reiciendis quaerat
                                accusamus numquam.</p>
                        </section>
                    </div>
                    <!-- Spied element -->
                </div>

                <div class="col-md-3">
                    <!-- Scrollspy -->
                    <div id="scrollspy" class="sticky-top">
                        <ul class="nav flex-column nav-pills menu-sidebar">
                            <li class="nav-item">
                                <a class="nav-link" href="#example-1">Section 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#example-2">Section 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#example-3">Section 3</a>
                                <ul class="nav flex-column ps-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#example-sub-A">Subsection A</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#example-sub-B">Subsection B</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#example-4">Section 4</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Scrollspy -->
                </div>
            </div>
        </div>
    </main>
@endsection
