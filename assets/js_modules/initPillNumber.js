

const addButton = document.querySelectorAll('.button-add');
const counterDisplay = document.getElementById('counter');

let counter = 0;
counterDisplay.append(counter);



const initPillNumber = () => {

    addButton.forEach( button => {
        button.addEventListener('click', () => {
            counter++; 
            counterDisplay.textContent = ` ${counter}`;  
        });
    });
}





export { initPillNumber }