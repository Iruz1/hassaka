<x-guest-layout>
    <!--  <div class="min-h-screen flex items-center justify-center bg-gray-50"> -->
        <div class="w-full max-w-md p-8 bg-white rounded shadow-lg text-center">
            <div class="flex justify-center mb-4">
                <div class="bg-purple-600 text-white rounded-full p-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A9.004 9.004 0 0112 15c2.21 0 4.209.804 5.879 2.138M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-purple-700 mb-4">Have an account?</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <input id="email" name="email" type="email" placeholder="Username"
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <input id="password" name="password" type="password" placeholder="Password"
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
                           required>
                </div>

                <div class="flex items-center justify-between text-sm text-purple-600 mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                               class="form-checkbox text-purple-600 focus:ring-purple-500">
                        <span class="ml-2">Remember Me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="hover:underline">Forgot Password</a>
                </div>

                <button type="submit"
                        class="w-full bg-purple-700 text-white py-2 rounded hover:bg-purple-800 transition">
                    Get Started
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
