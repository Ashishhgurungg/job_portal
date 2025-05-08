<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Categories') }}
        </h2>
    </x-slot>
    <style>
    .custom-add-button {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        font-weight: bold;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .custom-add-button:hover {
        background-color: #218838;
    }
</style>


    <div class="session-message-container">
        @if(session('success') || session('error') || session('added'))
            <div class="session-message">
                <p>{{ session('success') }}</p>
                <p>{{ session('error') }}</p>
                <p>{{ session('added') }}</p>
            </div>
        @endif
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Category List -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Categories List</h2>

                @foreach($categories as $category)
                    <div class="flex justify-between items-center border-b border-gray-200 py-2">
                        <span>{{ $category->name }}</span>
                        <a href="/delete-category/{{ $category->id }}"
                            onclick="return confirm('Are you sure you want to delete this category?');"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-sm font-semibold">
                            Delete
                        </a>

                    </div>
                @endforeach
            </div>

            <!-- Add Category Form -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Add New Category</h2>

                <form action="/category" method="post">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Category Name:</label>
                        <input type="text" name="category"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        @error('category')
                        <div class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="custom-add-button">
                        Add
                    </button>

                </form>
            </div>

        </div>
    </div>

    <!-- Reuse the session message styling -->
    <style>
        .session-message-container {
            width: 100%;
            max-width: 1280px;
            margin: 20px auto;
            padding: 0 16px;
        }

        @media (min-width: 640px) {
            .session-message-container {
                padding: 0 24px;
            }
        }

        @media (min-width: 1024px) {
            .session-message-container {
                padding: 0 32px;
            }
        }

        .session-message {
            background-color: #ffffff;
            border: 2px solid #10b981;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .session-message p {
            color: #047857;
            font-weight: 700;
            font-size: 1.125rem;
            line-height: 1.5;
            margin: 0;
        }
    </style>
</x-app-layout>
