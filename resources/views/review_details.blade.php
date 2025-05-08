<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review details') }}
        </h2>
    </x-slot>

    <div class="review-detail-container">
        <h1>Detail Review</h1>
        
        @foreach($reviews as $review)
        <div class="review-item">
            <div class="review-content">
                <p class="review-sender">
                    Review sent by: <span>{{$review->user->name}}</span>
                </p>
                <p class="review-message">
                    {{$review->review}}
                </p>
            </div>
            <a href="/delete-review/{{ $review->id }}" class="delete-button" onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
        </div>
        @endforeach
        
        <form action="/review-details" method="post" class="status-form">
            @csrf
            @foreach ($reviews as $review)
            <input type="hidden" name="id" value="{{ $review->id }}">
            @endforeach
            
            <div class="form-group">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status">
                    <option value="0" @if ($review->status == 0) selected @endif>Hide</option>
                    <option value="1" @if ($review->status == 1) selected @endif>Show</option>
                </select>
                
                <button type="submit" class="submit-button">Change</button>
            </div>
        </form>
    </div>

    <style>
        /* Main Container Styles */
        .review-detail-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .review-detail-container h1 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f1f1;
        }

        /* Review Item Styles */
        .review-item {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e1e4e8;
            border-radius: 8px;
            background-color: #f8fafc;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .review-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .review-content {
            flex-grow: 1;
            padding-right: 20px;
        }

        /* Text Styles */
        .review-sender {
            font-size: 16px;
            margin-bottom: 12px;
            color: #555;
        }

        .review-sender span {
            font-weight: 600;
            color: #4338ca; /* Indigo color */
            position: relative;
        }

        .review-sender span:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #4338ca;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease;
        }

        .review-item:hover .review-sender span:after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .review-message {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 10px;
        }

        /* Button Styles */
        .delete-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #e53e3e;
            color: white;
            font-weight: 500;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 16px;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(229, 62, 62, 0.3);
        }

        .delete-button:hover {
            background-color: #c53030;
        }

        /* Form Styles */
        .status-form {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e1e4e8;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .form-label {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-right: 15px;
        }

        select {
            padding: 10px 35px 10px 15px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 16px;
            color: #2d3748;
            background-color: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 20px;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #4338ca;
            box-shadow: 0 0 0 3px rgba(67, 56, 202, 0.2);
        }

        .submit-button {
            margin-left: 15px;
            padding: 10px 20px;
            background-color: #4338ca;
            color: white;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(67, 56, 202, 0.3);
        }

        .submit-button:hover {
            background-color: #3730a3;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(67, 56, 202, 0.4);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .review-detail-container {
                padding: 20px;
                margin: 20px;
            }

            .review-item {
                flex-direction: column;
            }

            .review-content {
                padding-right: 0;
                margin-bottom: 15px;
            }

            .delete-button {
                align-self: flex-end;
            }

            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-label {
                margin-bottom: 10px;
            }

            select, .submit-button {
                width: 100%;
                margin-left: 0;
            }

            .submit-button {
                margin-top: 15px;
            }
        }
    </style>
</x-app-layout>