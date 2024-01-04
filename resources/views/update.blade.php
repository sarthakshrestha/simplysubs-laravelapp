@extends('components.topbar')

@section('main-body')
    <div class="sub-main-container">
        <h1>Edit Subscription Item</h1>
    </div>

    <form action="{{ route('admin.updatesub.update', ['id' => $subscription->id]) }}" method="POST" enctype="multipart/form-data">        @csrf
        @method('PUT')
        <div class="product-card-horizontal">
            <div class="product-details">
                <div class="image-container">
                    <label for="image">Image:</label>
                    <input type="file" name="image" accept="image/*">
                    @if($subscription->image)
                        <img src="{{ asset('storage/' . $subscription->image) }}" alt="Current Image" style="max-width: 100px;">
                    @endif
                </div>
                <div class="product-title">
                    <label for="title">Title:</label>
                    <input type="text" name="title" value="{{ $subscription->title }}" required>
                </div>
                <div class="product-description">
                    <label for="description">Description:</label>
                    <textarea name="description" required>{{ $subscription->description }}</textarea>
                </div>
                <div class="product-price">
                    <label for="price">Price:</label>
                    <input type="number" name="price" value="{{ $subscription->price }}" required>
                </div>
                <button type="submit" class="buy-button">Update Subscription</button>
            </div>
        </div>
    </form>

    <form action="{{ route('admin.subscriptions.delete-subscription', ['id' => $subscription->id]) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this subscription?')">Delete Subscription</button>
    </form>


@endsection
