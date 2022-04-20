/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

let overlay = document.getElementById('overlay');
let sidebar = document.getElementById('sidebar');
let sidebarClose = document.getElementById('sidebar-close');
let sidebarOpen = document.getElementById('sidebar-open');

function showOverlay() {
    overlay.classList.replace('opacity-0', 'opacity-90');
    overlay.classList.replace('pointer-events-none', 'pointer-events-auto');
}

function hideOverlay() {
    overlay.classList.replace('opacity-90', 'opacity-0');
    overlay.classList.replace('pointer-events-auto', 'pointer-events-none');
}

function showSidebar() {
    sidebar.classList.replace('-right-5/6', 'right-0');
    sidebar.classList.replace('md:-right-96', 'md:right-0');
    sidebarClose.classList.replace('pointer-events-none', 'pointer-events-auto');
    sidebarClose.classList.replace('opacity-0', 'opacity-100');
}

function hideSidebar() {
    sidebar.classList.replace('right-0', '-right-5/6');
    sidebar.classList.replace('md:right-0', 'md:-right-96');
    sidebarClose.classList.replace('pointer-events-auto', 'pointer-events-none');
    sidebarClose.classList.replace('opacity-100', 'opacity-0');
}

overlay.addEventListener("click", hideOverlay);
overlay.addEventListener("click", hideSidebar);

sidebarClose.addEventListener("click", hideOverlay);
sidebarClose.addEventListener("click", hideSidebar);

sidebarOpen.addEventListener("click", showOverlay);
sidebarOpen.addEventListener("click", showSidebar);
