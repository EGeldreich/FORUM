// ELEMENTS
const diy = document.querySelector("#DIY");
const chi = document.querySelector("#Chi");
const far = document.querySelector("#Far");
const foo = document.querySelector("#Foo");
const gar = document.querySelector("#Gar");
let checkboxes = [diy, chi, far, foo, gar];

const topics = document.querySelectorAll(".topic");

// FILTER FUNCTION

// Set checkbox checked state depending on local storage
function loadFilters() {
    checkboxes.forEach((checkbox) => {
        const catId = checkbox.id;

        localStorage.setItem(catId, "true");
        checkbox.checked = true;
    });
}

// Save checkboxes state in localStorage
function saveFilters() {
    checkboxes.forEach((checkbox) => {
        localStorage.setItem(checkbox.id, checkbox.checked);
    });
    filterTopics();
}

// Filter home topics according to checkboxes
function filterTopics() {
    topics.forEach((topic) => {
        const topicCat = topic.getAttribute("data-category");
        const categoryFilter = document.getElementById(topicCat); //Find checkbox via data-category from topic
        if (categoryFilter && categoryFilter.checked) {
            topic.style.display = "block";
        } else {
            topic.style.display = "none";
        }
    });
}

// Event listener on checkboxes
checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", () => {
        saveFilters(); // Save checkbox state in LocalStorage
    });
});

// Filter on load
window.addEventListener("DOMContentLoaded", () => {
    loadFilters(); // Charger les filtres du localStorage
    filterTopics(); // Appliquer les filtres
});
