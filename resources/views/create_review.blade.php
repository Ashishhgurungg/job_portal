<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drop your review here') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/create-review" method="post">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="review" class="block text-gray-800 text-lg font-medium mb-3">
                                Review message:
                            </label>
                            <textarea id="review" name="review" rows="5" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 @error('review') border-red-500 @enderror" placeholder="Tell us what you think..."></textarea>
                            @error('review')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div hidden>
                            <label for="status" hidden>Status:</label>
                            <select id="status" name="status" hidden>
                                <option value="0" selected>hide</option>
                                <option value="1">show</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-5 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>