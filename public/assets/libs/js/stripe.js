// Create a Stripe client
var stripe = Stripe(stripe_key);
// Create an instance of Elements
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: "#32325d",
        lineHeight: "24px",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4",
        },
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a",
    },
};
// Create an instance of the card Element
var card = elements.create("card", { style: style });
// Add an instance of the card Element into the `card-element` <div>
card.mount("#card-element");
// Handle real-time validation errors from the card Element.
card.addEventListener("change", function (event) {
    var displayError = document.getElementById("card-errors");
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = "";
    }
});
// Handle form submission
// var form = document.getElementById("payment-form");
// form.addEventListener("submit", function (event) {
//     if ($('select[name="day_id"]').val() == "") {
//         showMessOk("Vui lòng chọn gói gia hạn!", "warning");
//         event.preventDefault();
//         return false;
//     }
//     event.preventDefault();
//     stripe.createToken(card).then(async function (result) {
//         if (result.error) {
//             // Inform the user if there was an error
//             var errorElement = document.getElementById("card-errors");
//             errorElement.textContent = result.error.message;
//         } else {
//             await axios
//                 .post(base_url_stripe, {
//                     post_id: post_id,
//                     post_option_id: app.getOptionId(),
//                     user_id: user_id,
//                     stripe_token: result.token.id,
//                     name: `${app.getName()}`,
//                     description: `${app.getDesc()}`,
//                     unit_amount: "USD",
//                     total: `${app.getTotal()}`,
//                     type: `stripe`,
//                     day: `${app.getExpiryDate()}`,
//                 })
//                 .then((res) => {
//                     showMessOk(
//                         "Thanh toán thành công, bài viết của bạn đang được kiểm duyệt!",
//                         "success"
//                     );
//                     setTimeout(() => {
//                         window.location.href = base_url_success;
//                     }, 3000);
//                 })
//                 .catch((error) => {});
//         }
//     });
// });

    
// });
$('#btn-submit').click(async ()=>{
    if(app.$data['payment_type'] == 2 && app.$data['credit_card'] == 'stripe')
    {
        if (!app.validate()) {
            showMessOk('Vui lòng nhập đầy đủ thông tin!', "warning");
            return;
        }
        stripe.createToken(card).then(async function (result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                $('#payment-form').append(
                    `<input type="hidden" name="pay_type" value="${'stripe'}" />`);
                $('#payment-form').append(
                    `<input type="hidden" name="stripe_token" value="${result.token.id}" />`);
                $('#payment-form').append(
                    `<input type="hidden" name="cover_price" value="${app.$data['cover_price']}" />`);
                $('#payment-form').submit();
            }
        });
    }
    else{
        $('#payment-form').append(
            `<input type="hidden" name="pay_type" value="${'stripe'}" />`);
        $("[name='pay_type']").remove();
        $("[name='stripe_token']").remove();
        $("[name='pay_id']").remove();
        if(app.$data['payment_type'] == 2 && app.$data['credit_card'] == 'alepay') // if have use alepay paid
        {
            $('#payment-form').append(
                `<input type="hidden" name="pay_type" value="${'alepay'}" />`);
            $('#payment-form').submit();
            return true;
        }
        $('#payment-form').submit();
    }
})
