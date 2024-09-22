//Checking if the script is loading successfully
console.log("Script loaded");

// The navbarList variable is declared as a global variable so that it can be accessed by all functions
let navbarList;



// This function is to caluclate the total price of the event based on the number of people attending in the booking form
function calculateAndDisplayTotalPrice() {
    const numPeopleInput = document.getElementById('numberOfPeople');
    const pppElement = document.getElementById('ppp'); 
    const totalPriceElement = document.getElementById('totalPrice'); 

    const numPeople = parseInt(numPeopleInput.value, 10);
    const ppp = parseFloat(pppElement.textContent || pppElement.innerText);

    if (!isNaN(numPeople) && !isNaN(ppp) && numPeople > 0) {
        const totalPrice = numPeople * ppp;
        totalPriceElement.value = totalPrice.toFixed(2);
    } else {
        totalPriceElement.value = '';
    }
}



// This is the main function for navbar switching and it will run once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
   
    navbarList = document.querySelector('.navbar_list');

      if (isLoggedIn) {
        // Logged-in version
        navbarList.innerHTML = `
            <li><a href="index.php">WHATS &#39;UP</a></li>
            <li><a href="eventslist.php">ALL EVENTS</a></li>
            <li><a href="contact.php">Enquiry</a></li>
	    <li><a href="https://www.figma.com/file/PgyiqMEKGvpAIyWCWB9tjK/Toone---Wireframe-(Community)?type=design&node-id=0%3A1&mode=design&t=H9dtCBTeCfBPfUsQ-1">WIREFRAME</a></li>
            <li><a href="userprofile.php">PROFILE</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
	    
        `;
    } else {
        // Logged-out version
        navbarList.innerHTML = `
            <li><a href="index.php">WHATS &#39;UP</a></li>
            <li><a href="eventslist.php">ALL EVENTS</a></li>
            <li><a href="contact.php">Enquiry</a></li>
	    <li><a href="https://www.figma.com/file/PgyiqMEKGvpAIyWCWB9tjK/Toone---Wireframe-(Community)?type=design&node-id=0%3A1&mode=design&t=H9dtCBTeCfBPfUsQ-1">WIREFRAME</a></li>
            <li><a href="logon.php">SIGN IN</a></li>
            <li><a href="registration.php">REGISTER</a></li>
	    
        `;
    }

    // This is the event listener for the burger menu for responsive design
    const burger = document.querySelector('.burger');
    burger.addEventListener('click', function () {
        navbarList.classList.toggle('nav-active');
        burger.classList.toggle('toggle');
    });

    document.addEventListener('click', function (event) {
        const isClickInsideNav = navbarList.contains(event.target);
        const isClickInsideBurger = burger.contains(event.target);

        if (!isClickInsideNav && !isClickInsideBurger) {
            navbarList.classList.remove('nav-active');
            burger.classList.remove('toggle');
        }
    });


// This is the Event listener for the number of people input field
    const numPeopleInput = document.getElementById('numberOfPeople');
    numPeopleInput.addEventListener('input', calculateAndDisplayTotalPrice);

    // Calling the function on script load to initialize the total price
    calculateAndDisplayTotalPrice();
});
