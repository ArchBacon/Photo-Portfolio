document.addEventListener('DOMContentLoaded', function () {
    const element = document.getElementById('tags');
    element.style.cursor = 'grab';

    let pos = {top: 0, left: 0, x: 0, y: 0};

    const mouseDownHandler = function (e) {
        element.style.cursor = 'grabbing';
        element.style.userSelect = 'none';

        pos = {
            left: element.scrollLeft, top: element.scrollTop, // Get the current mouse position
            x: e.clientX, y: e.clientY,
        };

        document.addEventListener('mousemove', mouseMoveHandler);
        document.addEventListener('mouseup', mouseUpHandler);
    };

    const mouseMoveHandler = function (e) {
        // How far the mouse has been moved
        const dx = e.clientX - pos.x;
        const dy = e.clientY - pos.y;

        // Scroll the element
        element.scrollTop = pos.top - dy;
        element.scrollLeft = pos.left - dx;
    };

    const mouseUpHandler = function () {
        element.style.cursor = 'grab';
        element.style.removeProperty('user-select');

        document.removeEventListener('mousemove', mouseMoveHandler);
        document.removeEventListener('mouseup', mouseUpHandler);
    };

    // Attach the handler
    element.addEventListener('mousedown', mouseDownHandler);
});

// Back to top button
const up = document.getElementById('up');
// Restore scroll position
const down = document.getElementById('down');
let showDownButton = false;
let lastScrollTop = 0;
let scrolledPosition = 0;

window.scrollY > window.innerHeight ? showBTTButton() : hideBTTButton();

window.addEventListener("scroll", function () {
    if (window.scrollY > scrolledPosition) {
        scrolledPosition = window.scrollY;
    }

    if (window.scrollY <= window.innerHeight) {
        hideBTTButton();

        if (showDownButton) {
            showRSPButton();
        }

        return;
    }

    let st = window.scrollY || document.documentElement.scrollTop;
    if (st > lastScrollTop) {
        showDownButton = false;
    }
    lastScrollTop = st <= 0 ? 0 : st;

    hideRSPButton();
    showBTTButton();
});

up.addEventListener("click", function () {
    showDownButton = true;
    scrolledPosition = window.scrollY;
    window.scrollTo({top: 0, behavior: 'smooth'});
});

down.addEventListener("click", function () {
    showDownButton = false;
    window.scrollTo({top: scrolledPosition, behavior: 'smooth'});
    scrolledPosition = 0;
});

function showBTTButton() {
    up.classList.replace('-right-24', 'right-0');
}

function hideBTTButton() {
    up.classList.replace('right-0', '-right-24');
}

function showRSPButton() {
    down.classList.replace('-right-24', 'right-0');
}

function hideRSPButton() {
    down.classList.replace('right-0', '-right-24');
}
