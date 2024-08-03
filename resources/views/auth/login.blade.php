<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('img/logo.svg') }}" width="162" height="50" alt="EduLight logo">
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="notification">
            <p>Your password has been updated.</p>
            <p>Click <a href="{{ route('signin') }}">HERE</a> to sign in.</p>
        </div>

    </x-authentication-card>
</x-guest-layout>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f3f4f6;
        color: #333;
        text-align: center;
        line-height: 1.6;
    }
    .notification {
    background: #fff;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: auto;
    }
    .notification a {
        color: blue;
    }
    .notification p {
        font-size: 21px;
    }

    </style>