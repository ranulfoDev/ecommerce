// Load PayPal SDK
const script = document.createElement('script');
script.src = "https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=PHP";
script.async = true;
script.onload = function () {
    initPayPalButton();
};
document.head.appendChild(script);

function initPayPalButton() {
    paypal.Buttons({

        // ✅ CREATE ORDER
        createOrder: (data, actions) => {
            const total = document.querySelector('[data-total]').getAttribute('data-total');

            return actions.order.create({
                intent: "CAPTURE",
                purchase_units: [
                    {
                        amount: {
                            currency_code: "PHP",
                            value: total
                        }
                    }
                ]
            });
        },

        // ✅ APPROVE PAYMENT
        onApprove: (data, actions) => {
            return actions.order.capture().then(function (details) {

                const total = document.querySelector('[data-total]').getAttribute('data-total');

                // ✅ SEND TO BACKEND (IMPORTANT)
                fetch("/place-order-paypal", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        transaction_id: data.orderID,
                        payer_email: details.payer.email_address,
                        amount: total,
                        name: document.querySelector('input[name="name"]').value,
                        address: document.querySelector('textarea[name="address"]').value,
                        payment_method: "paypal"
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = "/user/orders";
                    } else {
                        alert("Something went wrong!");
                    }
                });

            });
        },

        onError: (err) => {
            alert("Payment failed: " + err.message);
        }

    }).render('#paypal-button-container');
}