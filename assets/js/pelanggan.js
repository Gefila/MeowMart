document.addEventListener("DOMContentLoaded", function () {
	const navbar = document.querySelector(".navbar");
	const addScrollEffect = () => {
		if (window.scrollY > 10) {
			navbar.classList.add("navbar-scrolled");
		} else {
			navbar.classList.remove("navbar-scrolled");
		}
	};

	addScrollEffect(); // Check on load
	window.addEventListener("scroll", addScrollEffect);
});
