@include('layouts.head')
@section('Feed', 'title')

@isset($users)
    
    
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


@endisset

@isset($specifiedUser)
    <h1>Editing {{ $specifiedUser->name }}, to make a new user go <a href="http://localhost/admin/userdash/">here</a></h1>
@endisset

<form
    action="{{ $specifiedUser ? route('admin@updateUser', ['id' => $specifiedUser->id]) : route('admin@updateUser') }}"
    method="POST">
    @csrf
    @method('POST')
    <div class="flex items-center justify-center">
        <div class="flex flex-col">
            <label for="name" class="mb-2" class="hidden">Name:</label>
            <input type="text" name="name" id="name" placeholder="John Doe"
                value="{{ $specifiedUser ? $specifiedUser->name : '' }}" class="border border-gray-400 p-2 mb-4">
        </div>
        <div class="flex flex-col">
            <label for="email" class="mb-2">Email:</label>
            <input type="email" name="email" id="email" placeholder="JohnDoe@Example.com"
                value="{{ $specifiedUser ? $specifiedUser->email : '' }}" class="border border-gray-400 p-2 mb-4">
        </div>
        <div class="flex flex-col">
            <label for="title" class="mb-2">Title:</label>
            <input type="text" name="title" id="title" placeholder="Regular Blogger"
                value="{{ $specifiedUser ? $specifiedUser->permission->title : '' }}"
                class="border border-gray-400 p-2 mb-4">
        </div>
        <div class="flex flex-col">
            <label for="password" class="mb-2">New password:</label>
            <input type="password" name="password" id="password" placeholder="A strong password"
                class="border border-gray-400 p-2 mb-4">
        </div>

    </div>
    <table class="border-black border-2">
        <tr class="bg-gray-400 text-white">
            <th class="border-black border-2 w-auto p-2">Permissie</th>
            <th class="border-black border-2 w-auto p-2">Ja of Nee</th>
        </tr>

        <tr>
            <th>Eigen posts maken</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="create_update_post"
                    {{ $specifiedUser ? ($specifiedUser->permission->create_update_post ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Eigen posts verwijderen</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="delete_post"
                    {{ $specifiedUser ? ($specifiedUser->permission->delete_post ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Eigen reacties zetten</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="create_update_reply"
                    {{ $specifiedUser ? ($specifiedUser->permission->create_update_reply ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Eigen reacties verwijderen</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="delete_reply"
                    {{ $specifiedUser ? ($specifiedUser->permission->delete_reply ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Anderen reacties verwijderen</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="delete_others_reply"
                    {{ $specifiedUser ? ($specifiedUser->permission->delete_others_reply ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Anderen posts verwijderen</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="delete_others_post"
                    {{ $specifiedUser ? ($specifiedUser->permission->delete_others_post ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Onderwerpen beheren</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="manage_topics"
                    {{ $specifiedUser ? ($specifiedUser->permission->manage_topics ? 'checked' : '') : '' }}>
            </td>
        </tr>
        <tr>
            <th>Anderen beheren</th>
            <td class="border-gray-400 border-r-2 p-2">
                <input type="checkbox" name="manage_others"
                    {{ $specifiedUser ? ($specifiedUser->permission->manage_others ? 'checked' : '') : '' }}>
            </td>
        </tr>

    </table>

        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">
            {{ $specifiedUser ? 'Update' : 'Create' }}
        </button>
    </form>
