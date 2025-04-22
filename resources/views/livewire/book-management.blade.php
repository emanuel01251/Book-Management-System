<div class="container mx-auto p-4">
    <div class="mb-4">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input wire:model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="author">
                    Author
                </label>
                <input wire:model="author" type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('author') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="isbn">
                    ISBN
                </label>
                <input wire:model="isbn" type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('isbn') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea wire:model="description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                {{ $isEditing ? 'Update' : 'Add' }} Book
            </button>
        </form>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Title</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Author</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">ISBN</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Description</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $book->title }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $book->author }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $book->isbn }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $book->description }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <button wire:click="edit({{ $book->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <button wire:click="delete({{ $book->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</div>
