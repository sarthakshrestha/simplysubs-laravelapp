@extends('components.topbar')

@section('main-body')
    <div class="sub-main-container">
        <h1>Subscription Items <br> offered by SimplySubs</h1>
    </div>
        <!-- Add new subscription form POST method -->
    <form action="{{ route('admin.subscribe') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="product-card-horizontal">
                <div class="product-details">
                    <!-- Form Field to create subscriptions -->
                    <div class="image-container">
                        <label for="image">Image:</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                    <div class="product-title">
                        <label for="title">Title:</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="product-description">
                        <label for="description">Description:</label>
                        <textarea name="description" required></textarea>
                    </div>
                    <div class="product-price">
                        <label for="price">Price:</label>
                        <input type="number" name="price" step="0.01" min="0" required>
                    </div>
                    <button type="submit" class="buy-button">Add Subscription</button>
                </div>
                <p>Please add hi-res images of the subscription</p>
{{--                 Comment--}}
            </div>
        </form>
    </div>

@endsection
