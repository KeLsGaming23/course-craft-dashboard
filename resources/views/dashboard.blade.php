<x-app-layout>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Course Craft</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name  }}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ 'dashboard' }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ 'deleteCourse' }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Delete Course</a>
                    <a href="{{ 'deleteTopic' }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Delete Topics</a>
                    <a href="{{ 'createCourse' }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Create Course</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total User</p>
                                <h6 class="mb-0">{{ count($users) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Course Created</p>
                                <h6 class="mb-0">{{ count($courses) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Topic Created</p>
                                <h6 class="mb-0">{{ count($topics) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Total User:</h6>
                        {{count($users)}}
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created At:</th>
                                    <th scope="col">Updated At:</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php( $i=1 )
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <!-- diffForHumas() is for eloquent -->
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td> 
                                    <td>{{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td> 
                                    <td>{{ $user->role }}</td>
                                    <td class="d-flex justify-content-around">
                                        <form action="{{ route('makeAdmin', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-primary">Make it Admin</button>
                                        </form>
                                        <form action="{{ route('users.update.instructor', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-primary">Make it Instructor</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="position-relative">
                                    <img class="rounded-circle mx-auto my-auto" src="{{ asset('img/kels.jpg') }}" alt="" style="width: 100px; height: 100px;">
                                    <h1 class="text-center">
                                        <a class="text-center" href="#">
                                        Michael "Kels-Gaming" Alcoriza</a>
                                    </h1>
                                    <h4 class="text-center">Co Developer</h4>
                                    <h1 class="text-center">
                                        <a class="text-center" href="#"><i class="fa-brands fa-facebook"></i> 
                                        @mykeLs23</a>
                                    </h1>
                                    <h1 class="text-center">
                                        <a class="text-center" href="#"><i class="fa-brands fa-youtube"></i> 
                                        @KelsGaming23</a>
                                    </h1>
                                    <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="position-relative">
                                    <img class="rounded-circle mx-auto my-auto" src="{{ asset('img/lawrence.jpg') }}" alt="" style="width: 100px; height: 100px;">
                                    <h1 class="text-center">Lawrence Prieto</h1>
                                    <h4 class="text-center">Co Developer</h4>
                                    <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                                    <!-- Social Media Link -->
                                    <h1 class="text-center">
                                        <a class="text-center" href="https://www.facebook.com/lawrenxceprieto"><i class="fa-brands fa-facebook"></i> 
                                        @LawrencePrieto</a>
                                    </h1>
                                    <h1 class="text-center">
                                        <a class="text-center" href="https://twitter.com/KlawrencePrt"><i class="fa-brands fa-twitter"></i> 
                                        @LawrencePrieto</a>
                                    </h1>
                                    <h1 class="text-center">
                                        <a class="text-center" href="https://www.instagram.com/lawrennxxe"><i class="fa-brands fa-instagram"></i> 
                                        @LawrencePrieto</a>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="position-relative">
                                    <img class="rounded-circle mx-auto my-auto" src="{{ asset('img/user.jpg') }}" alt="" style="width: 100px; height: 100px;">
                                    <h1 class="text-center">Michael "Kels-Gaming" Alcoriza</h1>
                                    <h4 class="text-center">Co Developer</h4>
                                    <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="position-relative">
                                    <img class="rounded-circle mx-auto my-auto" src="{{ asset('img/dev4.jpg') }}" alt="" style="width: 100px; height: 100px;">
                                    <h1 class="text-center">Jeanson "Eujiko" Acal</h1>
                                    <h4 class="text-center">Co Developer</h4>
                                    <h1 class="text-center">
                                        <a class="text-center" href="https://www.facebook.com/jeanson.acal"><i class="fa-brands fa-facebook"></i> 
                                        @jeanson/Eujiko</a>
                                    </h1>
                                    <h1 class="text-center">
                                        <a class="text-center" href="https://www.instagram.com/jeanson_0/"><i class="fa-brands fa-instagram"></i> 
                                        @jeanson_0</a>
                                    </h1>
                                    <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Course Craft</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By: <a href="#">@Michael</a>
                            <br><a href="#">@Lawrence</a>
                            <br><a href="#">@Dex</a>
                            <br><a href="#">@Jeanson</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        <!-- Content End -->
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->
</x-app-layout>
