$(document).ready(function () {
  let originalData = [];

  $("#search-input").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    console.log("Search input value: ", value); // Debug log
    if (value) {
      const filteredData = searchTable(value, originalData);
      buildTable(filteredData);
    } else {
      buildTable(originalData);
    }
  });

  function searchTable(value, data) {
    var filteredData = [];
    for (var i = 0; i < data.length; i++) {

      var product_name = data[i].product_name.toLowerCase();
      var order_date = data[i].order_date;
      var total_amount = data[i].total_amount;
      if (
          product_name.includes(value) ||
          total_amount.includes(value) ||
          order_date.includes(value)
      ) {
        filteredData.push(data[i]);
      }
    }
    console.log("Filtered Data: ", filteredData); // Debug log
    return filteredData;
  }

  function buildTable(data) {
    var table = document.getElementById("myTable");
    table.innerHTML = `
            <tr class="table-row">
             
                <th></th>
                <th class="table-cell">PRODUCT</th>
                <th class="table-cell">ORDER DATE</th>
                <th class="table-cell">AMOUNT</th>
            </tr>`;
    for (var i = 0; i < data.length; i++) {
      var row = `
                <tr class="table-row">
               
                    <td class="table-cell">${data[i].product_image_url}</td>
                    <td class="table-cell">${data[i].product_name}</td>
                    <td class="table-cell">${data[i].order_date}</td>
                    <td class="table-cell">${data[i].total_amount}</td>
                </tr>`;
      table.innerHTML += row;
    }
    console.log("Table built with data: ", data); // Debug log
  }

  function fetchNewData() {
    var myReq = new XMLHttpRequest();
    myReq.open("GET", "OrderHistoryconnection.php", true);
    myReq.onload = function () {
      if (myReq.status === 200) {
        console.log("Data fetched from server: ", myReq.responseText); // Debug log
        originalData = JSON.parse(myReq.responseText);
        buildTable(originalData);
      } else {
        console.error("Error fetching data: ", myReq.status); // Debug log
      }
    };
    myReq.onerror = function () {
      console.error("Request error"); // Debug log
    };
    myReq.send();
  }

  fetchNewData(); // Initial data fetch

  setInterval(() => {
    if (!$("#search-input").val()) {
      fetchNewData();
    }
  }, 5000); // Adjust interval as needed
});
