(() => {
  /**
   * Import all the dependencies.
   * These are the WordPress core libraries that we need to use to create the plugin.
   * Also JSX is not supported in this file, so we need to use `createElement` to create elements.
   */
  const { registerPlugin } = wp.plugins;
  const { PluginSidebar, PluginSidebarMoreMenuItem } = wp.editPost;
  const { PanelBody, TextControl, Button } = wp.components;
  const { withSelect, withDispatch } = wp.data;
  const { compose } = wp.compose;
  const { createElement, Fragment, useState, useEffect } = wp.element;
  const { __ } = wp.i18n;

  /**
   * Configure SSMTData
   * Set license status, icon URLs, etc.
   */
  const iconURL =
    typeof SSMTData !== "undefined" && SSMTData.iconURL ? SSMTData.iconURL : "";
  const isLicensed =
    typeof SSMTData !== "undefined" && SSMTData.isLicensed ? true : false;
  const registrationURL =
    typeof SSMTData !== "undefined" && SSMTData.registrationURL
      ? SSMTData.registrationURL
      : "";

  /**
   * Get the plugin icon
   * Generate and return the component for the plugin icon.
   */
  const componentPluginIcon = (iconURL) => {
    if (!iconURL) return "admin-generic"; // Fallback icon to a default one

    return createElement("img", {
      src: iconURL,
      style: { width: "18.5px", height: "18.5px" },
      alt: "Stupid Simple Meta Tags Icon",
      className: "ssmt_icon",
    });
  };

  /**
   * Plugin Component.
   * This also contains the main component that will be rendered in the sidebar.
   * This is the main component that will contain everything else for this plugin.
   * Even the manu menu dropdown item is created here.
   */
  const componentSSMTPlugin = (props) => {
    const [metaTagRows, setMetaTagRows] = useState(props.metaTagRows);

    useEffect(() => {
      setMetaTagRows(props.metaTagRows);
    }, [props.metaTagRows]);

    const updateMetaTagRow = (index, key, value) => {
      const updated = [...metaTagRows];
      const newRow = { ...updated[index] };
      newRow[key] = value;
      updated[index] = newRow;
      setMetaTagRows(updated);
      props.setMetaTagRows(updated);
    };

    const deleteMetaTagRow = (index) => {
      const updated = [...metaTagRows];
      updated.splice(index, 1);
      setMetaTagRows(updated);
      props.setMetaTagRows(updated);
    };

    const addMetaTagRow = () => {
      const updated = [...metaTagRows];
      updated.push({ order: 0, value: "" });
      setMetaTagRows(updated);
      props.setMetaTagRows(updated);
    };

    props.isLicensed = isLicensed;
    props.registrationURL = registrationURL;
    return createElement(
      Fragment,
      null,
      createElement(
        PluginSidebarMoreMenuItem,
        {
          target: "ssmt-gutenberg-editor-extension",
          icon: componentPluginIcon(iconURL),
        },
        __("Stupid Simple Meta Tags", "ssmt")
      ),
      createElement(
        PluginSidebar,
        {
          name: "ssmt-gutenberg-editor-extension",
          title: __("Stupid Simple Meta Tags", "ssmt"),
          icon: componentPluginIcon(iconURL),
        },
        componentSidePanel({
          ...props,
          metaTagRows,
          updateMetaTagRow,
          deleteMetaTagRow,
          addMetaTagRow,
        })
      )
    );
  };

  /**
   * Side panel of the component.
   * This is when the plugin is active and the sidebar is open.
   */
  const componentSidePanel = (props) => {
    return createElement(
      PanelBody,
      null,
      createElement(
        "div",
        { style: { marginBottom: "1em", position: "relative" } },
        componentUnlicensedOverlay(props),
        componentMetaTagList(props),
      )
    );
  };

  /**
   * Unlicensed message component overlay.
   * This will be displayed when the user is not licensed.
   * It will contain a message and a button to register.
   */
  const componentUnlicensedOverlay = (props) => {
    if (props.isLicensed) {
      return null;
    }
    return createElement(
      "div",
      {
        className: "frosted-overlay",
        style: {
          position: "absolute",
          left: "-4px",
          top: "-4px",
          width: "calc(100% + 8px)",
          height: "calc(100% + 8px)",
          background: "rgba(0, 0, 0, 0.1)",
          backdropFilter: "blur(2px)",
          display: "flex",
          flexDirection: "column",
          justifyContent: "center",
          alignItems: "center",
          zIndex: "100",
          padding: "1em",
          gap: "1em",
        },
      },
      createElement(
        "div",
        {
          className: "overlay-message",
          style: {
            color: "red",
            backgroundColor: "rgba(255, 255, 255, 0.9)",
            padding: "4px",
            borderRadius: "8px",
            maxWidth: "90%",
            width: "auto",
          },
        },
        createElement(
          "p",
          { style: { color: "red", textAlign: "center", margin: "0px" } },
          __(
            "A license is required to manage advanced configuration features.",
            "ssmt"
          )
        )
      ),
      createElement(
        "a",
        {
          href: props.registrationURL,
          style: {
            backgroundColor: "#007CBA",
            color: "white",
            width: "100%",
            padding: "10px 20px",
            textDecoration: "none",
            borderRadius: "2px",
            fontWeight: "bold",
            display: "inline-block",
            textAlign: "center",
            cursor: "pointer",
          },
          onMouseEnter: (e) => {
            e.target.style.backgroundColor = "#006BA1";
          },
          onMouseLeave: (e) => {
            e.target.style.backgroundColor = "#007CBA";
          },
        },
        __("Register for free", "ssmt")
      )
    );
  };

  /**
   * Component containing the list of meta tags.
   * Also this will contain the add new button.
   */
  const componentMetaTagList = (props) => {
    let rows = props.metaTagRows;
    if(!props.isLicensed && rows.length == 0) {
      rows = [{ order: 0, value: "" }, { order: 0, value: "" }, { order: 0, value: "" }, { order: 0, value: "" }];
    }
    return createElement(
      Fragment,
      null,
      createElement(
        "table",
        {
          className: "ssmt-meta-tags-list-container",
        },
        createElement("thead", null, componentMetaTitleRow(props)),
        createElement(
          "tbody",
          null,
          rows.map((singleMetaRow, index) =>
            componentSingleMetaTagRow(props, singleMetaRow, index)
          )
        )
      ),
      createElement(
        Button,
        {
          isSecondary: true,
          onClick: props.addMetaTagRow,
        },
        __("+ Add New", "ssmt")
      )
    );
  };


  /**
   * Meta Title Row Component
   * This will contain the title row for the meta tags.
   */
  const componentMetaTitleRow = (props) => {
    return createElement(
      "tr",
      null,
      createElement(
        "td",
        null,
        createElement(
          "p",
          {
            style: { marginBottom: "0" },
          },
          __("Order", "ssmt")
        )
      ),
      createElement(
        "td",
        null,
        createElement(
          "p",
          {
            style: { marginBottom: "0" },
          },
          __("Meta Tag", "ssmt")
        )
      ),
      createElement("td", null)
    );
  };

  /**
   * Single Meta Tag Row Component
   * This will contain the input fields for a single meta tag row.
   * This will also contain the remove button
   */
  const componentSingleMetaTagRow = (props, singleMetaRow, index) => {
    if (!singleMetaRow) {
      singleMetaRow = { order: 0, value: "" };
    }

    function onChangeOrder(newOrder) {
      newOrder = parseInt(newOrder);
      if (isNaN(newOrder)) {
        newOrder = 0;
      }
      props.updateMetaTagRow(index, "order", newOrder);
    }
    function onChangeValue(newValue) {
      props.updateMetaTagRow(index, "value", newValue);
    }

    function onRemove() {
      props.deleteMetaTagRow(index);
    }

    return createElement(
      "tr",
      {
        key: index,
      },
      createElement(
        "td",
        null,
        createElement(TextControl, {
          value: singleMetaRow.order,
          size: "4",
          placeholder: "Order",
          onChange: onChangeOrder,
          style: { flex: "1" },
        })
      ),
      createElement(
        "td",
        null,
        createElement(TextControl, {
          value: singleMetaRow.value,
          placeholder: "Value",
          onChange: onChangeValue,
          style: { flex: "1" },
        })
      ),
      createElement(
        "td",
        null,
        createElement(
          Button,
          {
            isDestructive: true,
            isSmall: true,
            onClick: onRemove,
          },
          createElement("span", { className: "dashicons dashicons-trash" })
        )
      )
    );
  };

  /**
   * Apply withSelect and withDispatch
   */
  const applyWithSelect = withSelect((select) => {
    const store = select("core/editor") || select("core/block-editor");
    if (!store) {
      return { metaTagRows: "[]" };
    }
    const meta = store.getEditedPostAttribute("meta");
    return {
      metaTagRows:
        meta && meta.ssmt_advanced_settings_gutenberg_data
          ? meta.ssmt_advanced_settings_gutenberg_data
          : [],
    };
  });

  const applyWithDispatch = withDispatch((dispatch) => {
    const store = dispatch("core/editor") || dispatch("core/block-editor");
    if (!store) {
      return { setMetaTagRows: () => {} };
    }
    return {
      setMetaTagRows: (metaTagRows) => {
        metaTagRows = [...metaTagRows];
        store.editPost({
          meta: { ssmt_advanced_settings_gutenberg_data: metaTagRows },
        });
      },
    };
  });

  /**
   * Compose the components
   * This will compose the components with withSelect and withDispatch
   */
  const SSMTPluginSidebar = compose(
    applyWithSelect,
    applyWithDispatch
  )(componentSSMTPlugin);

  registerPlugin("ssmt-gutenberg-editor-extension", {
    render: SSMTPluginSidebar,
    icon: componentPluginIcon(iconURL),
  });
})();
