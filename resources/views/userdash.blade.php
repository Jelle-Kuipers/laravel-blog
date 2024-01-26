@include('layouts.head')
@section('Feed', 'title')

<h1>hello admin man!</h1>

<div class="flex justify-center">
    <table class="border-black border-2">
        <tr class="bg-gray-400 text-white">
            <th class="border-black border-2 w-auto p-2">Acties</th>
            <th class="border-black border-2 w-auto p-2">Id</th>
            <th class="border-black border-2 w-auto p-2">Naam</th>
            <th class="border-black border-2 w-auto p-2">Email</th>
            <th class="border-black border-2 w-auto p-2">Aanmaak datum</th>
            <th class="border-black border-2 w-auto p-2">Recentste wijziging</th>
        </tr>
        @foreach ($users as $key => $user)
            <tr class="{{ $key % 2 == 0 ? '' : 'bg-gray-300' }}">
                <td class="border-gray-400 border-r-2 p-2">
                    {{-- <input type="checkbox" name="selected_users[]" value="{{ $user->id }}"> --}}
                    <a class="mr-2 text-gray-200 bg-yellow-500 p-2 rounded-full hover:bg-yellow-400 hover:text-white"
                        href="{{ route('admin@specifyUser', ['id' => $user->id]) }}">Edit</a>
                    <a class="text-gray-200 bg-red-500 p-2 rounded-full hover:bg-red-400 hover:text-white"
                        href="{{ route('admin@deleteUser', ['id' => $user->id]) }}">Delete</a>
                </td>
                <td class="border-gray-400 border-r-2 p-2">{{ $user->id }}</td>
                <td class="border-gray-400 border-r-2 p-2">{{ $user->name }}</td>
                <td class="border-gray-400 border-r-2 p-2">{{ $user->email }}</td>
                <td class="border-gray-400 border-r-2 p-2">{{ $user->created_at->format('Y-m-d H:m:s') }}</td>
                <td class="border-gray-400 border-r-2 p-2">{{ $user->updated_at->format('Y-m-d H:m:s') }}</td>
            </tr>
        @endforeach
    </table>

</div>

<div class="w-auto flex items-center justify-self-center py-8 mx-auto">
    {{ $users->links('vendor.pagination.tailwind') }}
</div>

@if (isset($specifiedUser))
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div class="flex items-center justify-center">
            <div class="flex flex-col">
                <label for="name" class="mb-2">Name:</label>
                <input type="text" name="name" id="name" value="{{ $specifiedUser->name }}"
                    class="border border-gray-400 p-2 mb-4">
            </div>
            <div class="flex flex-col">
                <label for="email" class="mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ $specifiedUser->email }}"
                    class="border border-gray-400 p-2 mb-4">
            </div>
            <div class="flex flex-col">
                <label for="email" class="mb-2">Title:</label>
                <input type="email" name="email" id="email" value="{{ $specifiedUser->permission->title }}"
                    class="border border-gray-400 p-2 mb-4">
            </div>
            <div class="flex flex-col">
                <label for="password" class="mb-2">New password:</label>
                <input type="password" name="password" id="password" class="border border-gray-400 p-2 mb-4">
            </div>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Update</button>
        </div>
        <table class="border-black border-2">
            <tr class="bg-gray-400 text-white">
                <th class="border-black border-2 w-auto p-2">Permissie</th>
                <th class="border-black border-2 w-auto p-2">Ja of Nee</th>
            </tr>

            <tr>
                <th>Eigen posts maken</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->create_update_post ? 'checked' : '' }}>
                </td>
            </tr>
            <tr>
                <th>Eigen posts verwijderen</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->delete_post ? 'checked' : '' }}>
                </td>
            </tr>
            <tr>
                <th>Eigen reacties zetten</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->create_update_reply ? 'checked' : '' }}>
                </td>
            </tr>
            <tr>
                <th>Eigen reacties verwijderen</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->delete_reply ? 'checked' : '' }}>
                </td>
            </tr>
            <tr>
                <th>Anderen reacties verwijderen</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->delete_others_reply ? 'checked' : '' }}>
                </td>
            </tr>
            <tr>
                <th>Anderen posts verwijderen</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->delete_others_post ? 'checked' : '' }}>
                </td>
            </tr>
            <tr>
                <th>Anderen beheren</th>
                <td class="border-gray-400 border-r-2 p-2">
                    <input type="checkbox" {{ $specifiedUser->permission->manage_others ? 'checked' : '' }}>
                </td>
            </tr>

        </table>

    </form>
@endif
