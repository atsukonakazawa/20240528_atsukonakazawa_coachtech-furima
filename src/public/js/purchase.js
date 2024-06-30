// payment_way


document.addEventListener('DOMContentLoaded', function() {
    const paymentWaySelect = document.querySelector('#payment_way');
    const outputPaymentWay = document.querySelector('.output__payment-way');

    paymentWaySelect.addEventListener('change', function() {
        const selectedOption = paymentWaySelect.options[paymentWaySelect.selectedIndex];
        outputPaymentWay.textContent = selectedOption.textContent.trim();
    });
});