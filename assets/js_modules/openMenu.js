
const menuTop = document.getElementById("menu-top");
const iconMenu = document.getElementById("icon-menu");

const openMenu = () => {
   

    iconMenu.addEventListener("click", () => {
        const isVisible = menuTop.style.display === "block";
        menuTop.style.display = isVisible ? "none" : "block";

        const icon = document.querySelector("#icon-menu i");

        if (isVisible) {
            icon.classList.remove("bi-x-lg");
            icon.classList.add("bi-list");
        } else {
            icon.classList.add("bi-x-lg");
            icon.classList.remove("bi-list");
        }
        
    })

}

export {openMenu}