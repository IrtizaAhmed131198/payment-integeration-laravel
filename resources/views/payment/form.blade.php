<style>
    label {
        font-weight: bold;
        color: #ffffff
    }
</style>
<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 text-white">{{ session('success') }}</div>
        @endif

        <form id="payment-form" method="POST" action="{{ route('payment.make') }}">
            @csrf

            <label class="block mb-2">Payment Gateway:</label>
            <select name="gateway" id="gateway" class="border p-2 w-full mb-4">
                <option value="stripe">Stripe</option>
                <option value="paypal">PayPal</option>
            </select>

            <label class="block mb-2">Amount ($):</label>
            <input type="number" name="amount" class="border p-2 w-full mb-4" required>

            <div id="stripe-fields">
                <label class="block mb-2">Card Info:</label>
                <div id="card-element" class="border p-2 mb-4"></div>
                <input type="hidden" name="stripeToken" id="stripeToken">
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Pay Now</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        // Define custom styles for dark background
        const style = {
            base: {
                color: '#ffffff',
                fontSize: '16px',
                '::placeholder': {
                    color: '#cbd5e1' // light gray
                },
            },
            invalid: {
                color: '#ff6b6b',
                iconColor: '#ff6b6b'
            }
        };

        // Create the card element with custom styles
        const card = elements.create('card', { style });
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        const gateway = document.getElementById('gateway');
        const stripeFields = document.getElementById('stripe-fields');

        gateway.addEventListener('change', () => {
            stripeFields.style.display = gateway.value === 'stripe' ? 'block' : 'none';
        });

        form.addEventListener('submit', async (e) => {
            if (gateway.value === 'stripe') {
                e.preventDefault();
                const {token, error} = await stripe.createToken(card);
                if (error) {
                    alert(error.message);
                    return;
                }
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        });
    </script>
</x-app-layout>
