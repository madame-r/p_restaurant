const tabSelector = document.querySelectorAll('[data-tab-selector]');
const tabContent = document.querySelectorAll('[data-tab-content]');


const initTabs = () => {
    tabSelector.forEach(onetab => {
        onetab.addEventListener('click', () => {
            const target = document.querySelector(onetab.dataset.tabSelector);

          
            tabContent.forEach(onetab => {
                onetab.classList.remove('active');
            });

            
            target.classList.add('active');

            
            tabSelector.forEach(onetab => {
                onetab.classList.remove('active');
            });
            onetab.classList.add('active');
        });
    });
};


export { initTabs };
