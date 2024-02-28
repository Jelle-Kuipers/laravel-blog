@include('layouts.head')
{{-- page title --}}
<title>Fictional Forums - Recent Posts</title>
@include('layouts.header')
<div class="container">
    <div class="row">
        <!-- Admin Space -->
        {{-- <div class="col-lg-12" style="margin-top: 1.5rem;">
            <div id="adminText" class="d-flex justify-content-between">
                <h1>Admin Panel</h1>
            </div>
            <div id="adminContent">

            </div>
        </div> --}}
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Users Table
                </div>
                <div class="card-body">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="table-responsive bg-white">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">NAME</th>
                                                    <th scope="col">EMAIL</th>
                                                    <th scope="col">JOIN DATE</th>
                                                    <th scope="col">LEAVE DATE</th>
                                                    <th scope="col">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $key => $user)
                                                    <tr>
                                                        <th scope="row" style="color: #666666;">{{$user->id}}</th>
                                                        <td>admin noreply</td>
                                                        <td>Admin</td>
                                                        <td>tnixon12@example.com</td>
                                                        <td>61</td>
                                                        <td>
                                                            <a
                                                                href={{ route('user@specifyUser', ['id' => $user->id]) }}>Edit</a>
                                                            <form
                                                                action={{ route('user@deleteUser', ['id' => $user->id]) }}
                                                                method="POST">

                                                                <button type="submit"
                                                                    class="mr-2 text-gray-200 bg-red-500 p-2 rounded-full hover:bg-red-400 hover:text-white">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{ $users->links('vendor.pagination.bootstrap-5') }}
                                            <hr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
