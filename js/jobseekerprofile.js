

//overlay edit option
function openProfile(){
  var overlayprofile = document.getElementById('overlayEditProfile');
  overlayprofile.style.display='flex';
}

function closeProfile(){
  var overlayprofile = document.getElementById('overlayEditProfile');
  overlayprofile.style.display='none';
}
//overlay for education
function openEdu() {
  var overlayedu = document.getElementById('overlayEduContainer');
  overlayedu.style.display = 'flex';
}

function closeEdu() {
  var overlayedu = document.getElementById('overlayEduContainer');
  overlayedu.style.display = 'none';
}
// overlay for skill set
function openOver() {
  var overlay = document.getElementById('over');
  overlay.style.display = 'flex';
}

function closeOver() {
  var overlay = document.getElementById('over');
  overlay.style.display = 'none';
}


//overlay for certificates
function openCert(){
  var overlayCert = document.getElementById('openOverlayCert');
  overlayCert.style.display='flex';
}

function closeCert(){
  var overlayCert = document.getElementById('openOverlayCert');
  overlayCert.style.display='none';
}

//overlay experience
function openExp(){
  var overlayExp = document.getElementById('overlayExperienceContainer');
  overlayExp.style.display='flex';
}

function closeExp(){
  var overlayExp = document.getElementById('overlayExperienceContainer');
  overlayExp.style.display='none';
}
//function to delete education

function edudelete(id){
 var confirmed =  confirm ("Are you sure you want to delte?");
 if(confirmed){
  window.location.href="./joseekerprofileedit/edudelete.php?id=" +id;
 }
}


//function to delete skill 

function skilldelete(id){
  var confirmed = confirm("Are you sure you wan to delete?");
  if(confirmed){
    window.location.href = "./joseekerprofileedit/skilldelete.php?id="+id;
  }
}


//function to delete cert

function certdelete(id){
  var confirmed = confirm("Are you sure you want to delete?");
  if(confirmed){
    window.location.href = "./joseekerprofileedit/certdelete.php?id="+id;
  }
}

// function to delete experience

function expdelete(id){
  var confirmed = confirm("Are you sure you want to delete?");
  if(confirmed){
    window.location.href= "./joseekerprofileedit/expdelete.php?id="+id;
  }
}