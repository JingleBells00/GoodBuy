Stripe.setPublishableKey(
    "pk_test_51JIKEjErJvOw5CLU4cHeEKYmaNmYYb9hdQKoH7JCwOjG1mGWmr1OCB18BqafbiNAeXG2rt9LCScqgvp2NqlOe8ip00pZNLwOB1"
);

var $form = $("#checkout-form"); //declare your form id here

$form.submit(function (event) {
    $("#charge-error").addClass("hidden"); //hides credit card no if there is a mistake
    $form.find("button").prop("disabled", true); //disable buy now button before veryfying
    Stripe.card.createToken(
        {
            number: $("#card-number").val(),
            cvc: $("#card-cvc").val(),
            exp_month: $("#card-expiry-month").val(),
            exp_year: $("#card-expiry-year").val(),
            name: $("#card-name").val(),
        }, // get all id
        stripeResponseHandler
    );
    return false;
});

function stripeResponseHandler(status, response) {
    if (response.error) {
        //if there is a error
        $("#charge-error").removeClass("hidden");
        $("#charge-error").text(response.error.message); //prints error message
        $form.find("button").prop("disabled", false);
    } else {
        //if no error
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken"/>').val(token)); //creates api token

        // submit the form:
        $form.get(0).submit();
    }
}
