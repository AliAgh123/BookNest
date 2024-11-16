// function toggleMenu() {
// 	const navMenu = document.querySelector(".nav-menu");
// 	const nav = document.querySelector(".navbar");
// 	navMenu.classList.toggle("open");
// 	nav.classList.toggle("open");
// }

function toggleMenu() {
	const navContainer = document.querySelector(".nav-container");
	const navMenu = document.querySelector(".nav-menu");
	const nav = document.querySelector(".navbar");

	navContainer.classList.toggle("open");
	navMenu.classList.toggle("open");
	nav.classList.toggle("open");
}
