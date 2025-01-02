const addButtons = document.querySelectorAll('.button-add');

// Function to update the total price of the order
const updateTotalPrice = () => {
    const displayOrder = document.getElementById('display-order');
    const orderTotal = document.getElementById('total-price');

    // Check if displayOrder and orderTotal are valid
    if (!displayOrder || !orderTotal) {
        console.error('Error: Missing displayOrder or orderTotal elements');
        return;
    }

    let total = 0;

    // Loop through all recap items and calculate the total price
    const allItems = displayOrder.querySelectorAll('.recap-item');
    allItems.forEach(item => {
        const quantity = parseInt(item.querySelector('.item-quantity').textContent, 10);
        const itemPrice = parseFloat(item.querySelector('.item-total-price').textContent.split(' ')[0]);
        total += quantity * itemPrice;
    });

    // Update the total price on the page
    orderTotal.textContent = `${total.toFixed(2)} €`;
};

// Function to add an item to the recap
const addToRecap = (itemName, itemPrice, itemId) => {
    const displayOrder = document.getElementById('display-order');
    const orderTotal = document.getElementById('total-price');
    let totalPrice = 0;

    // Check if the item already exists in the recap
    const existingItem = displayOrder.querySelector(`[data-item-id="${itemId}"]`);

    if (existingItem) {
        const quantityElem = existingItem.querySelector('.item-quantity');
        let quantity = parseInt(quantityElem.textContent, 10) + 1;
        quantityElem.textContent = quantity;

        const totalPriceElem = existingItem.querySelector('.item-total-price');
        const totalPriceItem = (quantity * itemPrice).toFixed(2);
        totalPriceElem.textContent = `${totalPriceItem} €`;

        // Ensure updateTotalPrice is being called here
        updateTotalPrice();  // <-- This should be triggered here
    } else {
        // Add a new item to the recap
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

        displayOrder.appendChild(newItem);

        // Ensure updateTotalPrice is being called here as well
        updateTotalPrice();  // <-- This should also trigger updateTotalPrice
    }
};

// Function to initialize the order display behavior
const initOrderDisplay = () => {
    addButtons.forEach(button => {
        button.addEventListener('click', function () {
            const itemCard = this.closest('.item-card');
            const itemId = this.getAttribute('data-item-id');
            const itemName = itemCard.querySelector('h3').textContent;

            // Log the entire details-card for debugging
            const detailsCard = itemCard.querySelector('.details-card');

            // Extract all <p> elements from the details-card and log them
            const allPElements = detailsCard.querySelectorAll('p');
            allPElements.forEach((p, index) => {
                console.log(`p[${index}]:`, p.textContent);
            });

            // Price is now in the second <p> element (index 1)
            const priceTextElement = allPElements[1]; // 2nd <p> element for price
            if (priceTextElement) {
                const priceText = priceTextElement.textContent;

                // Clean the price text by removing ' €' and trimming any extra spaces
                const cleanedPriceText = priceText.replace(' €', '').trim();

                // Parse the cleaned price string into a number
                const itemPrice = parseFloat(cleanedPriceText);

                // If parsing fails, log an error and return
                if (isNaN(itemPrice)) {
                    console.error("Error: Price could not be parsed.");
                    return;
                }

                // Retrieve stock quantity directly from the "Add" button's data-stock attribute
                let stock = parseInt(this.getAttribute('data-stock'), 10);

                if (stock > 0) {
                    stock--;  // Decrement stock
                    this.setAttribute('data-stock', stock);  // Update the stock in the button's data attribute

                    // Add item to recap
                    addToRecap(itemName, itemPrice, itemId);
                } else {
                    alert('Out of stock!');
                }
            } else {
                console.error('Price element not found.');
            }
        });
    });
};

export { initOrderDisplay };
