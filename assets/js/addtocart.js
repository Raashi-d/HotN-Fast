const btnCart=document.querySelector('#cart-icon');
const cart=document.querySelector('.cart');
const btnClose=document.querySelector('#cart-close');


//open cart
btnCart.addEventListener('click',()=>{
    cart.classList.add('cart-active');
});

//close cart
btnClose.addEventListener('click',()=>{
    cart.classList.remove('cart-active');
});

document.addEventListener('DOMContentLoaded',loadFood);

function loadFood(){
    loadContent();
}

function loadContent(){
    //remove items from cart
    let btnRemove=document.querySelectorAll('.cart-remove');
    btnRemove.forEach((btn)=>{
        btn.addEventListener('click',removeItem);
    });

    //Prodect count change
    let qtyElements=document.querySelectorAll('.cart-quantity');
    qtyElements.forEach((input)=>{
        input.addEventListener('change',changeQty);
    });

    //prodect Cart
    let cartBtn=document.querySelectorAll('.cart-btn');
    cartBtn.forEach((btn)=>{
        btn.addEventListener('click',addCart);
    });

    updateTotal();

}

//Remove items from cart
function removeItem(){
    if(confirm('Are you sure you want to remove this item?')){
        let title=this.parentElement.querySelector('.cart-food-title').innerHTML;
        itemList=itemList.filter(el=>el.title!=title);
        this.parentElement.remove();
        loadContent();
    }
}

//Change quantity
function changeQty(){
    if(isNaN(this.value) || this.value<1){
        this.value=1;
    }
    loadContent();
}

let itemList=[];

//Add Cart
function addCart(){
    let food=this.parentElement;
    let title=food.querySelector('.dish-name').innerHTML;
    let price=food.querySelector('.dish-price').innerHTML;
    let imgSrc=food.querySelector('.food-img').src;
    //console.log(title, price, imgSrc);

    let newProduct={title,price,imgSrc}

    //check if product already exists
    if(itemList.find((el)=>el.title==newProduct.title)){
        alert("Product already exists");
        return;
    }else{
        itemList.push(newProduct);
    }


    let newProdectElement = createCartProdect(title, price, imgSrc);
    let element=document.createElement('div');
    element.innerHTML=newProdectElement
    let cartBasket=document.querySelector('.cart-content');
    cartBasket.append(element);
    loadContent();

}

function createCartProdect(title, price, imgSrc){
    return `
    <div class="cart-box">
          <img src="${imgSrc}" class="cart-img">
          <div class="ditail-box">
            <div class="cart-food-title">${title}</div>
            <div class="price-box">
              <div class="cart-price">${price}</div>
              <div class="cart-amt">${price}</div>
            </div>
            <input type="number" value="1" class="cart-quantity">
          </div>
          <img src="../images/delete.png" name="trash" class="cart-remove">         
      </div>
    `;
}

function updateTotal(){
    const cartItems=document.querySelectorAll('.cart-box');
    const totalValue=document.querySelector('.total-price');

    let total=0;

    cartItems.forEach(prodect=>{
        let priceElement=prodect.querySelector('.cart-price');
        let price=parseFloat( priceElement.innerHTML.replace("Rs. ",""));
        let qty=prodect.querySelector('.cart-quantity').value;
        total+=(price*qty);
        prodect.querySelector('.cart-amt').innerText="Rs. "+(price*qty);
    });

    totalValue.innerHTML='Rs. '+total;


    //add Product count 
    const cartCount=document.querySelector('.cart-item-count');
    let count=itemList.length;
    cartCount.innerHTML=count;

    if(count==0) {
        cartCount.style.display='none';
    }else{
        cartCount.style.display='block';
    }
}

//Bill payment
const btnPayment = document.querySelector('.buy-btn');
const billing = document.querySelector('.billing');
const btnClosePayment = document.querySelector('.close-icon');

// Function to check if the total is greater than 0
function isTotalGreaterThanZero() {
    const totalValue = parseFloat(document.querySelector('.total-price').innerHTML.replace("Rs. ", ""));
    return totalValue > 0;
}

// Open billing only if the total is greater than 0
btnPayment.addEventListener('click', () => {
    if (isTotalGreaterThanZero()) {
        billing.classList.add('billing-active');
    } else {
        alert("Sorry unable to complete the payment as the cart is empty.");
        // You can display a message or take other actions if the total is not greater than 0
        console.log('Total value is not greater than 0. Cannot place an order.');
    }
});

// Close billing
btnClosePayment.addEventListener('click', () => {
    billing.classList.remove('billing-active');
});
