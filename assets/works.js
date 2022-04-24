const overlay = document.getElementById('overlay');
const sidebar = document.getElementById('sidebar');
const sidebarClose = document.getElementById('sidebar-close');
const sidebarOpen = document.getElementById('sidebar-open');
const body = document.getElementById('body');

function showOverlay() {
    overlay.classList.replace('opacity-0', 'opacity-90');
    overlay.classList.replace('pointer-events-none', 'pointer-events-auto');
    body.classList.replace('overflow-y-auto', 'overflow-y-hidden');
}

function hideOverlay() {
    overlay.classList.replace('opacity-90', 'opacity-0');
    overlay.classList.replace('pointer-events-auto', 'pointer-events-none');
    body.classList.replace('overflow-y-hidden', 'overflow-y-auto');
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