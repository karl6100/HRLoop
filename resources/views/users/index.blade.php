<x-layouts.app :title="__('Users')">
    @section('content')
        <div class="row mb-3">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Users Management</h2>
                @can('role-create')
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                        <i class="fa fa-plus"></i> Create New User
                    </a>
                @endcan
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                                <span class="badge bg-success">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">
                                <i class="fa-solid fa-list"></i> Show
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $data->links('pagination::bootstrap-5') !!}
    @endsection
</x-layouts.app>
