const adminAjaxURL = feedback_data.adminAjaxURL ?? "";

const checkVersionUpdate = async () => {
  document.getElementById("license-status").classList.remove("d-none");
  document.getElementById("update-available").classList.add("d-none");
  document.getElementById("update-not-available").classList.add("d-none");
  setTimeout(async () => {
    try {
      const response = await fetch(adminAjaxURL, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "ssmt_check_for_updates",
        }),
      });
      const jsonResponse = await response.json();
      const data = jsonResponse.data;
      if (data.update_available) {
        document.getElementById("update-available").classList.remove("d-none");
        document.getElementById("update-check").classList.add("d-none");
      } else {
        document
          .getElementById("update-not-available")
          .classList.remove("d-none");
      }
    } catch (error) {
      console.error(error);
    } finally {
      document.getElementById("license-status").classList.add("d-none");
    }
  }, 300);
};

const feedback_init = () => {
  checkVersionUpdate();
};

window.onload = feedback_init;
