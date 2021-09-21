function removeCity() {
	var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
}

function openList(evt, cityName) {
  var i, tablinks;
  removeCity();
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < document.getElementsByClassName("city").length; i++) {
    tablinks[i].classList.remove("w3-light-grey");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.classList.add("w3-light-grey");
}

function show(id) {
	removeCity();
	document.getElementById("id01").style.display="block";
	document.getElementById("updateList").value=id;
	document.getElementById("deleteList").value=id;
	noDisplay4u();
	document.getElementById("updateListButton").style.display="block";
	document.getElementById("deleteListButton").style.display="block";
	document.getElementById("ListHeader").innerHTML= document.getElementById('lijst'+id).innerHTML;
}

function showTask(id) {
	removeCity();
	document.getElementById("id02").style.display="block";
	document.getElementById("updateTaskInput").value=id;
	document.getElementById("deleteTaskInput").value=id;
	noDisplay4u();
	document.getElementById("updateTaskButton").style.display="block";
	document.getElementById("deleteTaskButton").style.display="block";
	document.getElementById("TaskHeader").innerHTML= document.getElementById(id).innerHTML;
}

function createTask(lijstid) {
	removeCity();
	document.getElementById("id02").style.display="block";
	noDisplay4u();
	document.getElementById("addTaskInput").value=lijstid;
	document.getElementById("addTaskButton").style.display="block";
}

function createList(id) {
	removeCity();
	document.getElementById("id01").style.display="block";
	noDisplay4u();
	document.getElementById("addListButton").style.display="block";
}

function noDisplay4u() {
	document.getElementById("addListButton").style.display="none";
	document.getElementById("updateListButton").style.display="none";
	document.getElementById("deleteListButton").style.display="none";

	document.getElementById("addTaskButton").style.display="none";
	document.getElementById("updateTaskButton").style.display="none";
	document.getElementById("deleteTaskButton").style.display="none";
}