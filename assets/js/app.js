'use strict';

/* ===== Enable Bootstrap Popover (on element  ====== */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

/* ==== Enable Bootstrap Alert ====== */
//var alertList = document.querySelectorAll('.alert')
//alertList.forEach(function (alert) {
//  new bootstrap.Alert(alert)
//});

const alertList = document.querySelectorAll('.alert')
const alerts = [...alertList].map(element => new bootstrap.Alert(element))


/* ===== Responsive Sidepanel ====== */
const sidePanelToggler = document.getElementById('sidepanel-toggler'); 
const sidePanel = document.getElementById('app-sidepanel');  
const sidePanelDrop = document.getElementById('sidepanel-drop'); 
const sidePanelClose = document.getElementById('sidepanel-close'); 

window.addEventListener('load', function(){
	responsiveSidePanel(); 
});

window.addEventListener('resize', function(){
	responsiveSidePanel(); 
});


function responsiveSidePanel() {
    let w = window.innerWidth;
	if(w >= 1200) {
	    // if larger 
	    //console.log('larger');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
		
	} else {
	    // if smaller
	    //console.log('smaller');
	    sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
	}
};

sidePanelToggler.addEventListener('click', () => {
	if (sidePanel.classList.contains('sidepanel-visible')) {
		console.log('visible');
		sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
		
	} else {
		console.log('hidden');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
	}
});



sidePanelClose.addEventListener('click', (e) => {
	e.preventDefault();
	sidePanelToggler.click();
});

sidePanelDrop.addEventListener('click', (e) => {
	sidePanelToggler.click();
});



/* ====== Mobile search ======= */
const searchMobileTrigger = document.querySelector('.search-mobile-trigger');
const searchBox = document.querySelector('.app-search-box');

searchMobileTrigger.addEventListener('click', () => {

	searchBox.classList.toggle('is-visible');
	
	let searchMobileTriggerIcon = document.querySelector('.search-mobile-trigger-icon');
	
	if(searchMobileTriggerIcon.classList.contains('fa-magnifying-glass')) {
		searchMobileTriggerIcon.classList.remove('fa-magnifying-glass');
		searchMobileTriggerIcon.classList.add('fa-xmark');
	} else {
		searchMobileTriggerIcon.classList.remove('fa-xmark');
		searchMobileTriggerIcon.classList.add('fa-magnifying-glass');
	}
	
		
	
});


function togglePassword(inputId, iconId) {
	var passwordInput = document.getElementById(inputId);
	var eyeIcon = document.getElementById(iconId);

	if (passwordInput && eyeIcon) {
		if (passwordInput.type === "password") {
			passwordInput.type = "text";
			eyeIcon.classList.remove("fa-eye");
			eyeIcon.classList.add("fa-eye-slash");
		} else {
			passwordInput.type = "password";
			eyeIcon.classList.remove("fa-eye-slash");
			eyeIcon.classList.add("fa-eye");
		}
	}
}


// script.js
function formatPhoneNumber(input) {
    // Mengambil nilai input dan menghapus karakter selain angka
    let value = input.value.replace(/\D/g, ''); 

    // Format sesuai panjang input
    if (value.length > 12) {
        value = value.replace(/(\d{4})(\d{4})(\d{5})/, '$1 $2 $3');
    } else {
        value = value.replace(/(\d{4})(\d{4})(\d{0,4})/, '$1 $2 $3');
    }

    // Mengubah nilai input dengan format baru
    input.value = value.trim();
}

// Menambahkan event listener untuk memastikan hanya angka yang bisa dimasukkan
document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('kontak');
    phoneInput.addEventListener('input', function (event) {
        // Mengambil nilai input
        let value = event.target.value;
        
        // Menghapus karakter selain angka
        event.target.value = value.replace(/\D/g, '');
        
        // Memformat nomor telepon
        formatPhoneNumber(event.target);
    });
});

function updateMap() {
    const input = document.getElementById('maps-input');
    const iframe = document.getElementById('maps-iframe');
    const message = document.getElementById('error-message');
    const linkValue = input.value.trim();
    iframe.width = "400"; 
    iframe.height = "150"; 

    if (linkValue) {
        if (linkValue.startsWith('<iframe') && linkValue.includes('src=')) {
            const srcMatch = linkValue.match(/src=["']([^"']+)["']/); 
            if (srcMatch) {
                iframe.src = srcMatch[1];
                iframe.style.display = 'block'; 
                message.style.display = 'none'; // Hide the message
            } else {
                iframe.style.display = 'none'; 
                message.style.display = 'none'; // Hide the message
            }
        } else {
            iframe.style.display = 'none'; 
            message.textContent = "Format link tidak sesuai"; // Set the error message
            message.style.display = 'block'; // Show the message
        }
    } else {
        iframe.style.display = 'none';
        message.style.display = 'none'; // Hide the message
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateMap();
});

function toggleDescription(button) {
    var description = button.closest('tr').querySelector('.description');
    
    if (description.classList.contains('show')) {
        description.classList.remove('show');
        button.textContent = "+"; // Ubah tombol jadi plus
    } else {
        description.classList.add('show');
        button.textContent = "-"; // Ubah tombol jadi minus
    }
}














