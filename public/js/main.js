let sidebarOpen = document.getElementById('sidebar-open')
let sidebarClose = document.getElementById('sidebar-close')
let layout = document.getElementById('layout')

sidebarOpen.addEventListener('click', () => {
    layout.classList.remove('sidebar-collapsed')
})
sidebarClose.addEventListener('click', () => {
    layout.classList.add('sidebar-collapsed')
})

let dropdowns = document.querySelectorAll('.has-dropdown')

dropdowns.forEach((drop) => {
    drop.addEventListener('click', function (e) {
        e.stopPropagation();
        let allDropdown = document.querySelectorAll('.dropdown-menu')
        let target = document.querySelector(drop.getAttribute('data-target'))
        if (!target.contains(e.target)) {
            allDropdown.forEach((dropAll) => {
                if (dropAll.classList.contains('dropdown-menu-active') && dropAll !== target) {
                    dropAll.classList.remove('dropdown-menu-active')
                }
            })
            target.classList.toggle('dropdown-menu-active');
        }
    })
})

document.addEventListener('click', (e) => {
    let allDropdown = document.querySelectorAll('.dropdown-menu-active');
    allDropdown.forEach(drop => {
        if (!drop.contains(e.target)) {
            drop.classList.remove('dropdown-menu-active');
        }
    });
});

let menu = document.querySelectorAll('.has-menu-dropdown')

menu.forEach(item => {
    item.addEventListener('click', () => {
        menu.forEach(it => {
            if (it.classList.contains('active-menu') && it !== item) {
                it.classList.remove('active-menu')
            }
        })
        item.classList.toggle('active-menu')
    })
})

let formInput = document.querySelectorAll('.image-container')

if(formInput){
    formInput.forEach(form => {
        form.addEventListener('click', function () {
            let input = form.querySelector('input')
            input.click();
        })
    })
}