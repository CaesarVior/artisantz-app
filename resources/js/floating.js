document.addEventListener("DOMContentLoaded", () => {
    const floatingIcons = document.getElementById("floatingIcons");
    const scrollTopBtn = document.getElementById("scrollTopBtn");
    const svgIcons = floatingIcons.querySelectorAll("svg");

    let isVisible = false;
    let isAnimating = false;

    function showFloatingIcons() {
        if (isVisible || isAnimating) return;
        isAnimating = true;

        floatingIcons.classList.remove("hidden", "animate-slide-out-right");
        floatingIcons.classList.add("animate-slide-in-right");

        // Apply rotation animation to all SVG icons when floating icons appear
        svgIcons.forEach((icon) => {
            icon.classList.remove("rotate-on-unload");
            icon.classList.add("rotate-on-load");
        });

        floatingIcons.addEventListener(
            "animationend",
            () => {
                isAnimating = false;
                isVisible = true;
            },
            {
                once: true,
            }
        );
    }

    function hideFloatingIcons() {
        if (!isVisible || isAnimating) return;
        isAnimating = true;

        floatingIcons.classList.remove("animate-slide-in-right");
        floatingIcons.classList.add("animate-slide-out-right");

        // Apply rotation animation to all SVG icons when floating icons disappear
        svgIcons.forEach((icon) => {
            icon.classList.remove("rotate-on-load");
            icon.classList.add("rotate-on-unload");
        });

        floatingIcons.addEventListener(
            "animationend",
            () => {
                floatingIcons.classList.add("hidden");
                isAnimating = false;
                isVisible = false;
            },
            {
                once: true,
            }
        );
    }

    function toggleFloatingIcons() {
        const scrolled = window.scrollY || document.documentElement.scrollTop;
        const viewportHeight = window.innerHeight;

        if (scrolled > viewportHeight) {
            showFloatingIcons();
        } else {
            hideFloatingIcons();
        }
    }

    scrollTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("scroll", toggleFloatingIcons);
});
