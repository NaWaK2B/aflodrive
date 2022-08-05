const menuBurger = document.querySelector(".toggle_menu");
const navLink = document.querySelector(".block_link");
menuBurger.addEventListener("click", () => {
  navLink.classList.toggle("menu");
});

const menu = document.querySelector(".toggle_produit");
const navProduit = document.querySelector(".nav_produit");
menu.addEventListener("click", () => {
  navProduit.classList.toggle("menu_produit");
});
