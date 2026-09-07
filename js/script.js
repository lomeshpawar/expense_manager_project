function confirmDelete(){

return confirm("Are you sure to delete?");

}

document.getElementById("searchInput")
.addEventListener("keyup", function(){

var input = this.value.toLowerCase();

var rows =
document.querySelectorAll("#expenseTable tr");

rows.forEach(function(row,index){

if(index === 0) return;

var text = row.innerText.toLowerCase();

row.style.display =
text.includes(input)
? ""
: "none";

});

});