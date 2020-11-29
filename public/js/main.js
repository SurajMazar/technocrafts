const hamburger= document.querySelector('.hamburger');
const navMenu= document.querySelector('.navigation__menu');
const links= document.querySelector('.navigation__menu .navigation__menu__list');

hamburger.addEventListener('click',()=>{
  navMenu.classList.toggle('open');
});

// sticky header
// window.onscroll = function() {myFunction()};
// var header = document.getElementById("nav");
// var sticky = header.offsetTop;
// function myFunction() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("sticky");
//   } else {
//     header.classList.remove("sticky");
//   }
// } 

