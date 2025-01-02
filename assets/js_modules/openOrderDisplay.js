const buttonViewOrder = document.getElementById('view-order');
const divOrderDisplay = document.getElementById('display-order');

const openOrderDisplay = () => {
    buttonViewOrder.addEventListener("click", () => {
        // Toggle visibility of the order display
        const isVisible = divOrderDisplay.style.display === "flex";
        divOrderDisplay.style.display = isVisible ? "none" : "flex";
    });
};

export { openOrderDisplay };
