<x-app-layout>


    <img class="sign-logo" src="images/Logo.png" alt="logo" onclick="returnHome()" style="cursor: pointer;">

    <script>
        function returnHome(){
            window.location.href = "/";
        }
    </script>

    <h2 class="dashboard-link">Click the icon to start browsing in SimplySubs!</h2>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You have logged in successfully!") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
