/* Cart */
$("body").on("click", ".add-to-cart-link", function(e) {
    e.preventDefault();
    let id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        mod = $('#color-mod').val();
    $.ajax({
        url: `${path}/cart/add`,
        data: {id: id, qty: qty, mod: mod},
        type: "GET",
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка! Попробуйте позже.');
        }
    });
});

function showCart(cart) {
    console.log(cart);
}
/* Cart */

$("#currency").change(function() {
    window.location = "currency/change/?curr=" + $(this).val();
});

$('#color-mod').change(function() {
    let id = $(this).val(),
        title = $(this).find('option').filter(':selected').data('title'),
        price = $(this).find('option').filter(':selected').data('price'),
        basePrice = $('#base-price').data('price');
    if(price) {
        $('#base-price').text(symbolLeft + price + symbolRight);
    }
    else {
        $('#base-price').text(symbolLeft + basePrice + symbolRight);
    }
});