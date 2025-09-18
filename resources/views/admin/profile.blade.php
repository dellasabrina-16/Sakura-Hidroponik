@extends('master')

@section('isi')
    <main>
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <h2>Nama User</h2>
                            <h3>User Role</h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                                        Overview
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                        Edit Profile
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <!-- OVERVIEW -->
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Profile Image</div>
                                        <div class="col-lg-9 col-md-8">
                                            <img src="assets/img/profile-img.jpg" alt="Profile" width="100"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">user@example.com</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-3 col-md-4 label">Password</div>
                                        <div class="col-lg-9 col-md-8">********</div>
                                    </div>
                                </div>

                                <!-- EDIT PROFILE -->
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form>
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="assets/img/profile-img.jpg" alt="Profile" width="100">
                                                <input class="form-control mt-2" type="file" id="profileImage">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="user@example.com">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="Password"
                                                    value="12345678">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                            </div><!-- End Tab Content -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
