/* Filters */
$("body").on("click", "#js-filters input", function () {
  var checked = $("#js-filters input:checked");
  var data = "";

  checked.each(function () {
    data += this.value + ",";
  });

  if (data) {
    $.ajax({
        url: location.href,
        data: {filter: data},
        method: 'GET',
        beforeSend: function() {
            $('#js-preloader').fadeIn(300, function() {
                $('.product-one').hide();
            });
        },
        success: function(res) {
            $('#js-preloader').delay(500).fadeOut('slow', function() {
                $('.product-one').html(res).fadeIn();
                var url = location.search.replace(/filter(.+?)(&|$)/g, '');
                var newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                newURL = newURL.replace('&&', '&');
                newURL = newURL.replace('?&', '?');
                history.pushState({}, '', newURL);
            });
        },
        error: function() {
            alert('Error!');
        }
    })
  } else {
      window.location = location.pathname;
  }
});
/* Filters */

/* Search */
var products = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
    wildcard: "%QUERY",
    url: site_url + "/search/typeahead?query=%QUERY",
  },
});

products.initialize();

$("#typeahead").typeahead(
  {
    // hint: false,
    highlight: true,
  },
  {
    name: "products",
    display: "title",
    limit: 10,
    source: products,
  }
);

$("#typeahead").bind("typeahead:select", function (ev, suggestion) {
  // console.log(suggestion);
  window.location =
    site_url + "/search/?s=" + encodeURIComponent(suggestion.title);
});
/* Search */

/*Cart*/
$("body").on("click", ".add-to-cart-link", function (e) {
  e.preventDefault();
  var id = $(this).data("id"),
    qty = $(".quantity input").val() ? $(".quantity input").val() : 1,
    mod = $(".available select").val();
  $.ajax({
    url: "/cart/add",
    data: { id: id, qty: qty, mod: mod },
    type: "GET",
    success: function (res) {
      showColapseCart(res);
    },
    error: function () {
      alert("Error! Try later");
    },
  });
});

$("body").on("click", ".js-del-item", function () {
  var id = $(this).data("id");

  if ($("#js-colapse-cart").is(":visible")) {
    deleteItem(id, 0);
  } else {
    deleteItem(id);
  }
});

$("body").on("click", "#js-continue-shop-btn", function () {
  $("#js-colapse-cart").css("display", "none");
});

$("#js-show-cart").on("click", function (e) {
  e.preventDefault();
  getCart();
});

function showCart(cart) {
  if ($("#js-colapse-cart").is(":visible")) {
    $("#js-colapse-cart").css("display", "none");
  }

  if ($.trim(cart) == "<h3>Cart is empty</h3>") {
    $("#cart .modal-footer a, #cart .modal-footer .btn-danger").css(
      "display",
      "none"
    );
  } else {
    $("#cart .modal-footer a, #cart .modal-footer .btn-danger").css(
      "display",
      "inline-block"
    );
  }
  $("#cart .modal-body").html(cart);

  $(".js-cart-sum").text();

  if ($("#cart .js-cart-sum").text()) {
    $(".simpleCart_total").html($("#cart .js-cart-sum").text());
  } else {
    $(".simpleCart_total").text("Empty Cart");
  }

  $("#cart").modal();
}

function showColapseCart(cart) {
  if (!$("#js-colapse-cart").is(":visible")) {
    $("#js-colapse-cart").toggle();
  } else if ($.trim(cart) == "<h3>Cart is empty</h3>") {
    $("#js-colapse-cart").css("display", "none");
  }

  $("#js-colapse-cart").html(cart);

  if ($("#js-colapse-cart .js-cart-sum").text()) {
    $(".simpleCart_total").html($("#js-colapse-cart .js-cart-sum").text());
  } else {
    $(".simpleCart_total").text("Empty Cart");
  }
}

function getCart() {
  $.ajax({
    url: "/cart/show",
    type: "GET",
    success: function (res) {
      showCart(res);
    },
    error: function () {
      alert("Error");
    },
  });
}

function clearCart() {
  $.ajax({
    url: "/cart/clear",
    type: "GET",
    success: function (res) {
      showCart(res);
    },
    error: function () {
      alert("Error");
    },
  });
}

function deleteItem(id, is_modal = 1) {
  $.ajax({
    url: "/cart/delete",
    data: { id: id, is_modal: is_modal },
    type: "GET",
    success: function (res) {
      if ($("#js-colapse-cart").is(":visible")) {
        showColapseCart(res);
      } else {
        showCart(res);
      }
    },
    error: function () {
      alert("Error!");
    },
  });
}
/*Cart*/

// Search
$("#currency").change(function () {
  window.location = "currency/change?curr=" + $(this).val();
});

$(".available select").on("change", function () {
  var price = $(this).find("option").filter(":selected").data("price"),
    basePrice = $("#base-price").data("base");

  if (price) {
    $("#base-price").text(price);
  } else {
    $("#base-price").text(basePrice);
  }
});
