//used to store cart items
const cart = {};

//used to add an item to the cart
function addToCart(productName, productPrice) {
    //if the item is in the cart already, the quantity will increase and the total price will be updated depending on the number of your order
    if (cart[productName]) {
        cart[productName].quantity += 1; //increase the quantity
        cart[productName].totalPrice += productPrice; //adjust the total price
    } else {
        // If the item is not in the cart, add it, and it will automatically add as quantity of 1
        cart[productName] = {
            quantity: 1,
            totalPrice: productPrice
        };
    }
    //when adding an item to your cart, this line of code will update the cart display
    updateCartDisplay();
}

//used to remove an item from the cart
function removeFromCart(productName, productPrice) {
    //see if the item is on the cart and has at least one quantity
    if (cart[productName] && cart[productName].quantity > 0) {
        cart[productName].quantity -= 1; //decrease the quantity
        cart[productName].totalPrice -= productPrice; //adjust the total price

        //if the quantity becomes zero, the item will automatically remove from the cart
        if (cart[productName].quantity == 0) {
            delete cart[productName];
        }
    } else {
        //infrom the buyer, if they try to remove an item that is not in their cart
        alert('This item is not in the cart!');
    }
    //when adding an item to your cart, this line of code will update the cart display
    updateCartDisplay();
}

//used to update the cart display on the webpage
function updateCartDisplay() {
    const cartList = document.getElementById('products');
    cartList.innerHTML = ''; //this will clean the present cart

    //display each product by looping through the cart object
    for (let product in cart) {
        const listItem = document.createElement('li');
        listItem.innerText = `${product} 
                            - Quantity: ${cart[product].quantity} 
                            - Total Price: Php ${cart[product].totalPrice.toFixed(2)}`;
        cartList.appendChild(listItem); //it will list the item to the cart
    }
}