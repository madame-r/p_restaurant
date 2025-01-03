
const initSelectorsSelect = () => {


  
        const menuSelector = document.getElementById('menu-selector');
    
        if (menuSelector) {
            menuSelector.addEventListener('change', function () {
                const selectedSectionId = this.value;
                const section = document.getElementById(selectedSectionId);
    
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth' });
                } else {
                    console.error(`Section with id "${selectedSectionId}" not found.`);
                }
            });
        } else {
            console.error('Menu selector not found.');
        }
   
    
}

export {initSelectorsSelect}