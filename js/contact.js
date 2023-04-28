$(document).ready(function() {
    $("#popup-img").click(function() {
      const imageUrl = $(this).attr("src");
      const popupHtml = "<div class='popup'><img src='" + imageUrl + "' alt='Popup Image'></div>";
      $("body").append(popupHtml);
    });
    $(document).on("click", ".popup", function() {
      $(this).remove();
    });
  });
  
const contactList = document.getElementById('contact-list');
const viewMoreBtn = document.getElementById('view-more-btn');
const viewLessBtn = document.getElementById('view-less-btn');

let showAll = false;

function toggleShowAll() {
showAll = !showAll;
showListItems();
}

function showListItems() {
const listItems = contactList.children;

if (showAll) {
    for (let i = 2; i < listItems.length; i++) {
    listItems[i].style.display = 'list-item';
    }
    viewMoreBtn.style.display = 'none';
    viewLessBtn.style.display = 'inline-block';
} else {
    for (let i = 2; i < listItems.length; i++) {
    listItems[i].style.display = 'none';
    }
    viewMoreBtn.style.display = 'inline-block';
    viewLessBtn.style.display = 'none';
}
}

viewMoreBtn.addEventListener('click', toggleShowAll);
viewLessBtn.addEventListener('click', toggleShowAll);

showListItems();
