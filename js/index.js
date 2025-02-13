loadCards();

function loadCards() {
    const url = new URL(location.href);
    let search = url.searchParams.get('search');
    if (!search) return;
    
    search = search.toLowerCase();
    const dashboardGrid = document.getElementsByClassName('dashboard-grid')[0];
    for (const card of dashboardGrid.children) {
        if (!card.getElementsByTagName('h2')[0].textContent.toLowerCase().includes(search)) {
            card.style.display = 'none';
        }
    }
}