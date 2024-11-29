let openSearch = document.getElementById("openSearch")
let searchContainer = document.getElementById("search-container")

openSearch.addEventListener('click',()=>{
    searchContainer.classList.toggle('d-lg-block');
    if(openSearch.classList.contains('fa-search')){
        openSearch.classList.remove('fa-search')
        openSearch.classList.add('fa-times')
    }
    else{
        openSearch.classList.remove('fa-times')
        openSearch.classList.add('fa-search')
    }
})

let sidebarBtn = document.getElementById('filter')
let sidebar = document.getElementById('sidebar')
let overlay = document.getElementById('page_overlay')
let sidebarClose = document.querySelectorAll('.sidebar-close')

if(sidebarBtn){
    sidebarBtn.addEventListener('click',()=>{
        if(window.screen.width<992){
            sidebar.classList.toggle('sidebar-active')
            overlay.classList.toggle('d-none')
            document.body.classList.toggle('overflow-hidden')
        }
    })
    if(window.screen.width<992){
        sidebarClose.forEach(element => {
            element.addEventListener('click',()=>{
                sidebar.classList.toggle('sidebar-active')
                overlay.classList.toggle('d-none')
                document.body.classList.toggle('overflow-hidden')
        })
    });}
}

let quantityButton = document.querySelectorAll('.cart-quantity-btns')

quantityButton.forEach((btn)=>{
    btn.addEventListener('click',function(e){
        let input = btn.querySelector('.quantity-cart')
        if(e.target.classList.contains('quantity-increment')){
            input.value = parseInt(input.value) + 1
        }
        if(e.target.classList.contains('quantity-decrement') && input.value > 1){
            input.value = input.value - 1
        }
    })
})

let quantity = document.getElementById('quantity-cart')
let increment = document.getElementById('incrementQuantity')
let decrement = document.getElementById('decrementQuantity')

if(quantity){
    increment.addEventListener('click',()=>{
        quantity.value = parseInt(quantity.value) + 1
    })
    decrement.addEventListener('click',()=>{
        if(quantity.value>1){
            quantity.value -=1
        }
    })
    console.log(quantity.value)
}