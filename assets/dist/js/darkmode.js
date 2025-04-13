document.addEventListener("DOMContentLoaded", function () {
	const toggle = document.getElementById("dark-mode-toggle");
	const icon = document.getElementById("dark-mode-icon");
	const body = document.body;

	function applyTheme(theme) {
		if (theme === "dark") {
			body.classList.add("dark-mode");
			icon.classList.remove("fa-moon");
			icon.classList.add("fa-sun");
		} else {
			body.classList.remove("dark-mode");
			icon.classList.remove("fa-sun");
			icon.classList.add("fa-moon");
		}
	}

	// Set initial theme
	const savedTheme = localStorage.getItem("theme") || "light";
	applyTheme(savedTheme);

	// Toggle theme on click
	toggle.addEventListener("click", function (e) {
		e.preventDefault();
		const newTheme = body.classList.contains("dark-mode") ? "light" : "dark";
		localStorage.setItem("theme", newTheme);
		applyTheme(newTheme);
	});
});
