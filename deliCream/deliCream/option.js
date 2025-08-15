const coneNCup = document.getElementById('coneNCup');
const flavors = document.getElementById('flavors');
const topping = document.getElementById('topping');
const addOn = document.getElementById('addOn');
const bg = document.getElementById('bg');

const conePage = document.getElementById('cone');
const flavorPage = document.getElementById('flavor');
const toppingsPage = document.getElementById('toppings');
const addOnPage = document.getElementById('add-ons');
const toppings = document.querySelectorAll('.toppings');

let orders = [];
let orderCount = {};

coneNCup.addEventListener('click',()=>{
    conePage.classList.remove('d-none');
    flavorPage.classList.add('d-none');
    toppingsPage.classList.add('d-none');
    addOnPage.classList.add('d-none');
    bg.classList.add('d-none');
});

flavors.addEventListener('click',()=>{
    conePage.classList.add('d-none');
    flavorPage.classList.remove('d-none');
    toppingsPage.classList.add('d-none');
    addOnPage.classList.add('d-none');
    bg.classList.add('d-none');
});

topping.addEventListener('click',()=>{
    conePage.classList.add('d-none');
    flavorPage.classList.add('d-none');
    toppingsPage.classList.remove('d-none');
    addOnPage.classList.add('d-none');
    bg.classList.add('d-none');
})

addOn.addEventListener('click',()=>{
    conePage.classList.add('d-none');
    flavorPage.classList.add('d-none');
    toppingsPage.classList.add('d-none');
    addOnPage.classList.remove('d-none');
    bg.classList.add('d-none');
})
let limit = 13;
function addQty(flavor, name){
    let element = document.getElementById(flavor+"Qty");
    let qty = parseInt(element.textContent);
    if (qty != limit){
        qty += 1;
        element.textContent = qty;
    }
    orders.push(name);
    for (let items of orders){
        if (orderCount[items]=== undefined){
            orderCount[items] = 0;
        }
    }
    orderCount[name]=orderCount[name]+1;
    console.log(orderCount);
    console.log(orders);
    updateCart();
}
function minusQty(flavor, name){
    let element = document.getElementById(flavor+"Qty");
    let qty = parseInt(element.textContent);
    const index = orders.indexOf(name);
    if(index !== -1){
        orders.splice(index, 1);
        if(orderCount[name]>0){
            orderCount[name] = orderCount[name]-1;
        }
    }
    if (qty > 0){
        qty -= 1;
        element.textContent = qty;
    }
    console.log(orderCount);
    updateCart();
}
function updateCart(){
    const cartItems = document.getElementById('orderItems');
    let cart = "";
    for (let item in orderCount){
        if (orderCount[item]===0){
            cart += '';
        }else{
            cart += `<p>${item}: ${orderCount[item]}</p>`;
        }
    }
    cartItems.innerHTML = cart;
}
toppings.forEach((tp)=>{
    tp.addEventListener('click', (e)=>{
        let poop = document.querySelector('.'+e.currentTarget.id);
        tp.classList.toggle('active');
        if(e.currentTarget.classList.contains('active')){
            orders.push(e.currentTarget.id);
            for (let items of orders){ 
                if (orderCount[items]=== undefined){
                orderCount[items] = 0;
                }
            }
            orderCount[e.currentTarget.id]=orderCount[e.currentTarget.id]+1;
        }else{
            const index = orders.indexOf(e.currentTarget.id);
            if(index !== -1){
                orders.splice(index, 1);
                if(orderCount[e.currentTarget.id]>0){
                    orderCount[e.currentTarget.id] = orderCount[e.currentTarget.id]-1;
                }
            }
        }
        updateCart();
    })
})