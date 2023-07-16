function checkuser() {
  alert("Company cannot apply for any job post :)");
}
function applyjob(job_id) {
  var success = (window.location.href = "./job_apply.php?id=" + job_id);
  if (success) {
    alert("Job applied successfully :)");
  }
}
