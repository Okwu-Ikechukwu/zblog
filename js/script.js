const navitems = document.querySelector('.nav-items');
const opennavbtn = document.querySelector('#open-nav-btn');
const closenavbtn = document.querySelector('#close-nav-btn');


// opens nav dropdown
const opennav = () => {
    navitems.style.display = 'flex';
    opennavbtn.style.display = 'none';
    closenavbtn.style.display = 'inline-block';
}

// close nav dropdown
const closenav = () => {
    navitems.style.display = 'none';
    opennavbtn.style.display = 'inline-block';
    closenavbtn.style.display = 'none'
}

opennavbtn.addEventListener('click', opennav);
closenavbtn.addEventListener('click', closenav);


const sidebar = document.querySelector('aside');
const showsidebarbtn = document.querySelector('#show-sidebar-btn');
const  hidesidebarbtn = document.querySelector('#hide-sidebar-btn');

// show sidebar on small devices
const showsidebar = () => {
    sidebar.style.left = '0';
    showsidebarbtn.style.display = 'none';
    hidesidebarbtn.style.display = 'inline-block';
}

// hide sidebar on small devices
const hidesidebar = () => {
    sidebar.style.left = '-100%';
    showsidebarbtn.style.display = 'inline-block';
    hidesidebarbtn.style.display = 'none';
}

showsidebarbtn.addEventListener('click', showsidebar);
hidesidebarbtn.addEventListener('click', hidesidebar);

