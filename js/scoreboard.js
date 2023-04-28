$(document).ready(function() {
    // Sort function for Win X % column
    function sortTable() {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.querySelector(".score-table table");
      switching = true;
      while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length - 1; i++) {
          shouldSwitch = false;
          x = rows[i].getElementsByTagName("TD")[2];
          y = rows[i + 1].getElementsByTagName("TD")[2];
          if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }
  
    // Search function for Username column
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".score-table table tbody tr").filter(function() {
        $(this).toggle($(this).children(":first").text().toLowerCase().indexOf(value) > -1)
      });
    });
  
    // Sort button click event handler
    $("#sort-btn").click(function() {
      sortTable();
    });
  });
  