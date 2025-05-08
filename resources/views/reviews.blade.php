<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reviews lists') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="css/reviews.css">  

    <div class="reviews-container">
        @if(session('changed'))
            <div class="session-message success">
                {{session('changed')}}
            </div>
        @endif

        @if(session('deleter'))
            <div class="session-message error">
                {{session('deleter')}}
            </div>
        @endif

        @forelse($reviews as $review)
            <div class="review-item">
                <div>
                    <p class="review-sender">
                        Review sent by: <span>{{$review->user->name}}</span>
                    </p>
                    <select name="status" id="status" disabled>
                        <option value="0" @if ($review->status == 0) selected @endif>hidden</option>
                        <option value="1" @if ($review->status == 1) selected @endif>shown</option>
                    </select>
                </div>
                <a href="{{route('reviewDetails', ['id'=>$review->id])}}" class="view-review-link">View review</a>
            </div>
        @empty
            <div class="empty-state">
                <p>
                    No reviews are given
                </p>
            </div>
        @endforelse

        <div class="pagination">
            {{ $reviews->links() }}
        </div>
    </div>
</x-app-layout>