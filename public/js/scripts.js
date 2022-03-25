//calculate all checked ingredient
$('input[type=checkbox]').change(function () {

    let checkboxes = document.querySelectorAll("input[type=checkbox]");
    let summ = 0.0;
    Array.from(checkboxes)
        .filter(i => i.checked)
        .map(i => summ += parseFloat(i.value));

    let price = summ * 1.5;

    document.getElementById("totalPrice").innerHTML = price.toFixed(2);
});

function createOrder() {
    let pizzaId = document.getElementById('pizzaId').getAttribute('value');

    let checkboxes = document.querySelectorAll("input[type=checkbox]");
    let orderElements = [];
    orderElements = Array.from(checkboxes)
        .filter(i => i.checked)
        .map(i => {
            let ingredientQueue = document.getElementById("ingredientQueue-" + i.id).value;
            return {
                pizzaId: pizzaId, ingredientId: i.id, ingredientQueue: ingredientQueue
            };
        });

    let elements = Object.assign({}, orderElements);

    $.ajax({
        type: "POST",
        url: $('#pizzaBay').data('url'),
        data: {elements: elements},
        success: function (data) {
            insertOrder(data.order);
            document.getElementById("orderModal").style.display = "block";
        },
        error: function (error) {
            alert(error.responseText);
        }
    });
}

//insert order data in modal
function insertOrder(order) {
    let ingredientList = '';
    Array.from(order.ingredients)
        .map(ingredient => {
            ingredientList += "<div>" + ingredient + "</div>";
        });

    document.getElementById("orderNr").innerHTML = "<p>" + order.orderNr + "<\p>";
    document.getElementById("orderPizzaName").innerHTML = order.pizzaName;
    document.getElementById("orderIngredients").innerHTML = ingredientList;
    document.getElementById("orderTotalPrice").innerHTML = order.totalPrice;
}

//if modal is open after mouse event redirect to menu page
window.onclick = function (event) {
    let modal = document.getElementById("orderModal");
    if (event.target == modal) {
        window.location.href = '/';
    }
}
