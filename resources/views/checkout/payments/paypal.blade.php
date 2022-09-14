<div id="paypal-button-container"></div>

<script
    src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . env('PAYPAL_MODE') . '.client_id') }}&currency=USD"
></script>
@push('footer-scripts')
    @vite(['resources/js/paypal-payment.js'])
@endpush
