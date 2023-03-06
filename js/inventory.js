'use strict'

 // Get a list of vehicles in inventory based on the classificationId
 let classificationList = document.querySelector("#classificationList");
 classificationList.addEventListener("change", function () {
    // window.alert(`classificationList: ${data}`);
  let classificationId = classificationList.value;
  console.log(`classificationId is: ${classificationId}`);
  let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;
  fetch(classIdURL)
  .then(function (response) {
   if (response.ok) {
    // return response.json();
    return response.text();
   }
   throw Error("Network response was not OK");
  })
  .then(function (data) {
   console.log(data);
   buildInventoryList(data);
  })
  .catch(function (error) {
   console.log('There was a problem: ', error.message)
  })
 })

// Build inventory items into HTML table components and inject into DOM
function buildInventoryList(dataTemp) {
    const data = JSON.parse((dataTemp.split('<!-- json -->').pop()));
    let numVehicles = data.length;
    let inventoryDisplay = document.getElementById("inventoryDisplay");
    // window.alert(`buildInventoryList: ${data}`);
    // Set up the table labels
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';
    // Set up the table body
    dataTable += '<tbody>';
    // window.alert(`buildInventoryList dataTable: ${dataTable}`);
    // Iterate over all vehicles in the array and put each in a row
    if (numVehicles === 0) {
     dataTable += '<tr><td colspan="3">Sorry, no vehicles were found in that category.</td></tr>';
    } else {
        data.forEach(function (element) {
        console.log(element.invId + ", " + element.invModel);
        dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`; 
        dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`; 
        })
    }
    dataTable += '</tbody>';
    // window.alert(`buildInventoryList dataTable Final: ${dataTable}`);
    // Display the contents in the Vehicle Management view
    inventoryDisplay.innerHTML = dataTable;
   }




