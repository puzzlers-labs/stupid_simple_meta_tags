const init = () => {
  const isLicensed =
    (ssmt_register_license_data.isLicensed ?? "false") === "true"
      ? true
      : false;
  const registerLicenseLink =
    ssmt_register_license_data.registerLicenseLink ?? "";

  if (!isLicensed) {
    (() => {
      setTimeout(() => {
        window.location.href = registerLicenseLink;
      }, 3000);
    })();
  }
};

window.onload = init;
