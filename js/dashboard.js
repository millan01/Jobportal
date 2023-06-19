

// function that handles tab clicks
function openTab(evt, tabName) {

  // variables declared here
  var i, tabcontent, tabs;

  // Hide all tab content except the first one
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Set the first tab as active
  tabs = document.getElementsByClassName("tabs");
  for (i = 0; i < tabs.length; i++) {
    tabs[i].className = tabs[i].className.replace("active","");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className+="active";
}
document.getElementById("defaultOpen").click();


//function to delete jobseeker

function confirmDeleteseeker(Job_seeker_id) {
  var confirmed = confirm('Are you sure you want to delete?');
  if (confirmed) {
      window.location.href ="adminaction.php?Job_seeker_id=" + Job_seeker_id;
  }
}

//function to delete company
function confirmDelete(company_id) {
  var confirmed = confirm('Are you sure you want to delete?');
  if (confirmed) {
      window.location.href ="adminaction.php?company_id=" + company_id;
  }
}