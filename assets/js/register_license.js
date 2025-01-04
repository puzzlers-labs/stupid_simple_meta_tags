const init = () => {
  const isLicensed =
    (ssmt_register_license_data.isLicensed ?? "false") === "true"
      ? true
      : false;
  const registerLicenseURL =
    ssmt_register_license_data.registerLicenseURL ?? "";
  const validateLicenseURL =
    ssmt_register_license_data.validateLicenseURL ?? "";
  const validateNonce = ssmt_register_license_data.validateNonce ?? "";
  const returnURL = ssmt_register_license_data.returnURL ?? "";

  if (!isLicensed) {
    (() => {
      setTimeout(() => {
        window.location.href = registerLicenseURL;
      }, 3000);
    })();
  } else {
    (() => {
      setTimeout(async () => {
        const licenseStatusText = document.getElementById(
          "license-status-text"
        );
        try {
          const response = await fetch(validateLicenseURL, {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
              action: "ssmt_validate_license",
              nonce: validateNonce,
            }),
          });
          const jsonResponse = await response.json();
          const data = jsonResponse.data;

          const licenseStatus = document.getElementById("license-status");
          licenseStatus.innerHTML = ""; // Clear the loading animation
          const icon = document.createElement("span");
          icon.style.fontSize = "24px";
          icon.classList.add("dashicons");

          if (data.license_status === "valid") {
            licenseStatusText.innerHTML = `License is valid.`;
            licenseStatusText.style.color = "green";

            icon.classList.add("dashicons-yes");
            icon.style.color = "green";
            if (returnURL) {
              (() => {
                const returnURLMessage = document.createElement("span");
                returnURLMessage.style.color = "black";
                returnURLMessage.innerHTML = `Returning to <a href='${returnURL}'>this page</a>.`;
                licenseStatusText.appendChild(document.createElement("br"));
                licenseStatusText.appendChild(returnURLMessage);

                setTimeout(() => {
                  window.location.href = returnURL;
                }, 3000);
              })();
            }
          } else {
            licenseStatusText.innerHTML = "License is invalid.";
            licenseStatusText.style.color = "red";

            icon.classList.add("dashicons-no");
            icon.style.color = "red";
          }
          licenseStatus.appendChild(icon);
        } catch (error) {
          console.error(error);
          licenseStatusText.innerHTML =
            "Cannot validate license, please try again later.";
        }
      }, 3000);
    })();
  }
};

window.onload = init;
