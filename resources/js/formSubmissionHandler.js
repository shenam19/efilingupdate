document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("recordStoreForm");
  const submitButton = document.getElementById("submitButton");

  form.addEventListener("submit", function (event) {
    event.preventDefault();
    submitButton.disabled = true;
    submitButton.innerHTML =
      '<i class="fas fa-spinner fa-spin"></i> Processing...';
    this.submit();
    return true;
  });
});
