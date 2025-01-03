const addButtons = document.querySelectorAll('.button-add');

// Function to update the total price of the order
const updateTotalPrice = () => {
    const displayOrder = document.getElementById('display-order');
    const orderTotal = document.getElementById('total-price');

    if (!displayOrder || !orderTotal) {
        console.error('Error: Missing displayOrder or orderTotal elements');
        return;
    }

    let total = 0;

    const allItems = displayOrder.querySelectorAll('.recap-item');
    allItems.forEach(item => {
        const quantity = parseInt(item.querySelector('.item-quantity').textContent, 10);
        const itemPrice = parseFloat(item.querySelector('.item-total-price').textContent.split(' ')[0]);
        total += quantity * itemPrice;
    });

    orderTotal.textContent = `${total.toFixed(2)} €`;
};

// Function to add an item to the recap
const addToRecap = (itemName, itemPrice, itemId, stockElem) => {
    const displayOrder = document.getElementById('display-order');
    const existingItem = displayOrder.querySelector(`[data-item-id="${itemId}"]`);

    if (existingItem) {
        const quantityElem = existingItem.querySelector('.item-quantity');
        let quantity = parseInt(quantityElem.textContent, 10) + 1;
        quantityElem.textContent = quantity;

        const totalPriceElem = existingItem.querySelector('.item-total-price');
        const totalPriceItem = (quantity * itemPrice).toFixed(2);
        totalPriceElem.textContent = `${totalPriceItem} €`;

        updateTotalPrice();
    } else {
        const newItem = document.createElement('div');
        newItem.classList.add('recap-item');
        newItem.setAttribute('data-item-id', itemId);

        newItem.innerHTML = `
            <span class="item-name">${itemName}</span>
            <button class="decrease-quantity">-</button>
            <span class="item-quantity">1</span>
            <button class="increase-quantity">+</button>
            <span class="item-total-price">${itemPrice.toFixed(2)} €</span>
        `;

        // Attach event listeners for +/- buttons
        newItem.querySelector('.increase-quantity').addEventListener('click', () => {
            const quantityElem = newItem.querySelector('.item-quantity');
            let quantity = parseInt(quantityElem.textContent, 10) + 1;
            quantityElem.textContent = quantity;

            const totalPriceElem = newItem.querySelector('.item-total-price');
            totalPriceElem.textContent = `${(quantity * itemPrice).toFixed(2)} €`;

            updateTotalPrice();
        });

        newItem.querySelector('.decrease-quantity').addEventListener('click', () => {
            const quantityElem = newItem.querySelector('.item-quantity');
            let quantity = Math.max(parseInt(quantityElem.textContent, 10) - 1, 0);
            quantityElem.textContent = quantity;

            const totalPriceElem = newItem.querySelector('.item-total-price');
            totalPriceElem.textContent = `${(quantity * itemPrice).toFixed(2)} €`;

            if (quantity === 0) {
                newItem.remove(); // Remove item if quantity is 0
            }

            updateTotalPrice();
        });

        displayOrder.appendChild(newItem);
        updateTotalPrice();
    }
};

// Initialize order display behavior
const initOrderDisplay = () => {
    addButtons.forEach(button => {
        button.addEventListener('click', function () {
            const itemCard = this.closest('.item-card');
            const itemId = this.getAttribute('data-item-id');
            const itemName = itemCard.querySelector('h3').textContent;

            // Extract price
            const detailsCard = itemCard.querySelector('.details-card');
            const priceTextElement = detailsCard.querySelectorAll('p')[1]; // Assuming price is the second <p>
            const cleanedPriceText = priceTextElement.textContent.replace(' €', '').trim();
            const itemPrice = parseFloat(cleanedPriceText);

            if (isNaN(itemPrice)) {
                console.error("Error: Price could not be parsed.");
                return;
            }

            // Decrement stock and update UI
            let stock = parseInt(this.getAttribute('data-stock'), 10);
            if (stock > 0) {
                stock--;
                this.setAttribute('data-stock', stock);

                // Update stock display in DOM
                const stockDisplay = detailsCard.querySelector('p:nth-child(4)'); // Assuming stock is the 4th <p>
                if (stockDisplay) {
                    stockDisplay.textContent = `Stock: ${stock}`;
                }

                // Add to recap
                addToRecap(itemName, itemPrice, itemId, stockDisplay);
            } else {
                alert('Out of stock!');
            }
        });
    });
};

export { initOrderDisplay };
