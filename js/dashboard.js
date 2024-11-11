// script.js

function toggleSidebar() {
	const sidebar = document.getElementById("sidebar");
	const toggleButton = document.querySelector(".sidebar-toggle");
	const isExpanded =
		toggleButton.getAttribute("aria-expanded") === "true" || false;

	sidebar.classList.toggle("show");
	toggleButton.setAttribute("aria-expanded", !isExpanded);
}
