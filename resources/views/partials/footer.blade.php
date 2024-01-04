<footer>
    <div class="row">
        <div class="column">
            <p><a class="about-us-link" href="/about-us">About Us</a></p>
            <div class="sub-row">
                <p>Why Simply Subs</p>
            </div>
            <div class="sub-row">
                <p>Journey</p>
            </div>
            <div class="sub-row">
                <p>Compatibility & Troubleshooting</p>
            </div>
        </div>
        <div class="column">
            <p>Contact Us</p>
            <div class="sub-row">
                <p>Email Us @ simply@subs.io</p>
            </div>
            <div class="sub-row">
                <p>Call Us @ 6789998212</p>
            </div>
            <div class="sub-row">
                <p>Visit our headquarters in Jamal, Kathmandu</p>
            </div>
        </div>
        <div class="column">
{{--            If the admin is authenticated then their controls are located under the footer--}}
            @auth
                @if(auth()->check() && auth()->user()->is_admin)
                    <p>Admin Controls</p>
                    <div class="sub-row">
                        <p><a href="/admin/create" style="text-decoration: none">Create Product Item</a></p>
                    </div>
                    <div class="sub-row">
                        <p><a href="/admin/updatesub/" style="text-decoration: none">Update Product Item</a></p>
                    </div>
                @else


                @endif
            @endauth
            <p>Reviews</p>
            <div class="sub-row">
                <p>User Reviews</p>
            </div>
            <div class="sub-row">
                <p>Licensing</p>
            </div>
        </div>
    </div>
    <div class="lower-row">
        <p>Powered by Laravel - SimpleSubs</p>
    </div>
</footer>
