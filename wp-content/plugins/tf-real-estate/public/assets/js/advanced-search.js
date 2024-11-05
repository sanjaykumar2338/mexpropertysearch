var advancedSearch = advancedSearch || {};
(function ($) {
  "use strict";
  var ajaxUrl = "";
  var classWrap = ".tfre-property-advanced-search, #popup_filter_modal";
  advancedSearch = {
    init: function () {
      if (typeof advancedSearchVars === "undefined") {
        return;
      }
      ajaxUrl = advancedSearchVars.ajaxUrl;

      if (!advancedSearchVars.inElementor) {
        $(".tfre-property-country-ajax", classWrap).select2({
          placeholder: "Property Country",
          allowClear: true,
        });
        $(".tfre-province-state-ajax", classWrap).on(
          "select2:select",
          function (e) {
            $(".tfre-province-state-ajax", classWrap).select2({
              placeholder: "Province/State",
              allowClear: true,
            });
          }
        );
        $(".tfre-property-neighborhood-ajax", classWrap).on(
          "select2:select",
          function (e) {
            $(".tfre-property-neighborhood-ajax", classWrap).select2({
              placeholder: "Neighborhoods",
              allowClear: true,
            });
          }
        );
        // $(".tfre-province-state-ajax", classWrap).select2();
        // $(".tfre-property-neighborhood-ajax", classWrap).select2();
        $(".tfre-property-type-ajax", classWrap).select2({
          placeholder: "Property Types",
          allowClear: true,
        });
        $(".tfre-property-label-ajax", classWrap).select2({
          placeholder: "Property Labels",
          allowClear: true,
        });
        $(".tfre-property-bathroom-ajax", classWrap).select2({
          placeholder: "Baths: Any",
          allowClear: true,
        });
        $(".tfre-property-bedroom-ajax", classWrap).select2({
          placeholder: "Beds: Any",
          allowClear: true,
        });
        $(".tfre-property-room-ajax", classWrap).select2({
          placeholder: "Rooms",
          allowClear: true,
        });
        $(".tfre-property-garage-ajax", classWrap).select2({
          placeholder: "Garages: Any",
          allowClear: true,
        });
        $(".tfre-min-size", classWrap).select2({
          placeholder: "Min size",
          allowClear: true,
        });
        $(".tfre-max-size", classWrap).select2({
          placeholder: "Max size",
          allowClear: true,
        });
        $(".tfre-min-price", classWrap).select2({
          placeholder: "Min Price",
          allowClear: true,
        });
        $(".tfre-max-price", classWrap).select2({
          placeholder: "Max Price",
          allowClear: true,
        });
        $(".tfre-min-garage-size", classWrap).select2({
          placeholder: "Min garage size",
          allowClear: true,
        });
        $(".tfre-max-garage-size", classWrap).select2({
          placeholder: "Max garage size",
          allowClear: true,
        });
        $(".tfre-min-land-size", classWrap).select2({
          placeholder: "Min Land Area",
          allowClear: true,
        });
        $(".tfre-max-land-size", classWrap).select2({
          placeholder: "Max Land Area",
          allowClear: true,
        });

        this.showHideSearchFieldFeatures();
        this.onClickedStatusFilter();
      }
      $(".tfre-property-country-ajax", classWrap).length == 0 &&
        this.getProvinceStatesByCountry();
      $(".desktop .tfre-property-country-ajax", classWrap).on(
        "change",
        function () {
          var ctrl = $(this);
          advancedSearch.getProvinceStatesByCountry(ctrl);
        }
      );

      $(".mobile .tfre-property-country-ajax", classWrap).on(
        "change",
        function () {
          var ctrl = $(this);
          advancedSearch.getProvinceStatesByCountry(ctrl);
        }
      );

      $(".desktop .tfre-province-state-ajax", classWrap).on(
        "change",
        function () {
          var ctrl = $(this);
          advancedSearch.getNeighborhoodsByProvinceState(ctrl, "desktop");
        }
      );

      $(".mobile .tfre-province-state-ajax", classWrap).on(
        "change",
        function () {
          var ctrl = $(this);
          advancedSearch.getNeighborhoodsByProvinceState(ctrl, "mobile");
        }
      );

      this.executeAdvancedSearch();
      this.executeAdvancedSearchInMobile();
      this.registerRangeSliderFilter();
      this.checkValidationSaveAdvancedSearchForm();
      this.onClickSaveAdvancedSearch();
    },
    getProvinceStatesByCountry: function (ctrl) {
      var selectedCountry = ctrl
        ? ctrl.val()
        : advancedSearchVars.country_default;
      $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: {
          action: "get_province_states_by_country_ajax",
          country: selectedCountry,
          type: 1,
          is_slug: "1",
        },
        beforeSend: function () {
          $(".tfre-province-state-ajax", classWrap).prop("disabled", true);
        },
        success: function (response) {
          $(".tfre-province-state-ajax", classWrap).html(response);
          $(".tfre-province-state-ajax", classWrap).prop("disabled", false);
          var valSelected = $(".tfre-province-state-ajax", classWrap).attr(
            "data-selected"
          );
          if (typeof valSelected !== "undefined") {
            $(".tfre-province-state-ajax", classWrap).val(valSelected);
          }
        },
      });
    },
    getNeighborhoodsByProvinceState: function (ctrl, classWrapperCtrl) {
      var countryElement = $(ctrl)
        .parents(".state-field")
        .closest("." + classWrapperCtrl)
        .find(".country-field")
        .find("select.tfre-property-country-ajax");
      if ($(ctrl).length) {
        var selectedCountry =
          countryElement.length > 0
            ? countryElement.val()
            : advancedSearchVars.country_default;
        var selectedState = ctrl.val();
        $.ajax({
          type: "POST",
          url: ajaxUrl,
          data: {
            action: "get_neighborhoods_by_province_state_ajax",
            country: selectedCountry,
            state: selectedState,
            type: 1,
            is_slug: "1",
          },
          beforeSend: function () {
            $(".tfre-property-neighborhood-ajax", classWrap).prop(
              "disabled",
              true
            );
          },
          success: function (response) {
            $(".tfre-property-neighborhood-ajax", classWrap).html(response);
            $(".tfre-property-neighborhood-ajax", classWrap).prop(
              "disabled",
              false
            );
            var valSelected = $(
              ".tfre-property-neighborhood-ajax",
              classWrap
            ).attr("data-selected");
            if (typeof valSelected !== "undefined") {
              $(".tfre-property-neighborhood-ajax", classWrap).val(valSelected);
            }
          },
        });
      }
    },
    registerRangeSliderFilter: function () {
      $(".tfre-range-slider-filter", classWrap).each(function () {
        var rangeSlider = $(this);
        advancedSearch.setRangeSliderFilter(rangeSlider);
      });
    },
    setRangeSliderFilter: function (element) {
      var $container = element,
        min = parseInt($container.attr("data-min-default")),
        max = parseInt($container.attr("data-max-default")),
        minValue = $container.attr("data-min"),
        maxValue = $container.attr("data-max"),
        $rangeFilter = $container.find(".tfre-range-slider"),
        minText = "",
        maxText = "",
        x,
        y;
      $rangeFilter.slider({
        min: min,
        max: max,
        range: true,
        values: [minValue, maxValue],
        slide: function (event, ui) {
          x = ui.values[0];
          y = ui.values[1];
          $container.attr("data-min", x);
          $container.attr("data-max", y);
          $container.find("input.min-input-request").attr("value", x);
          $container.find("input.max-input-request").attr("value", y);

          if ($container.find("span").hasClass("not-format")) {
            minText = x;
            maxText = y;
          } else {
            minText = mainJSTFRE.numberFormat(x);
            maxText = mainJSTFRE.numberFormat(y);
          }

          if ($container.hasClass("tfre-range-slider-price")) {
            if (advancedSearchVars.currencyPosition === "before") {
              minText = advancedSearchVars.currencySign + minText;
              maxText = advancedSearchVars.currencySign + maxText;
            } else {
              minText = minText + advancedSearchVars.currencySign;
              maxText = maxText + advancedSearchVars.currencySign;
            }
          }

          $container.find("span.min-value").html(minText);
          $container.find("span.max-value").html(maxText);
        },
        stop: function (event, ui) { },
      });
    },
    executeAdvancedSearch: function () {
      $(
        ".desktop .tfre-advanced-search-btn, .desktop .tf-advanced-search-btn",
        classWrap
      ).on("click", function (e) {
        e.preventDefault();
        var searchForm = $(this).closest(".search-properties-form"),
          searchUrl = searchForm.data("href"),
          searchField = [],
          queryString = "?";
        // loop all field search
        $('.search-form-content .search-field, .tf-search-condition-tab .search-field, .search-more-options .search-field').each(function () {
          var $this = $(this),
            fieldName = $this.attr('name'),
            currentValue = $this.val(),
            defaultValue = $this.data('default-value');

          if (typeof fieldName !== 'undefined') {
            // check has value
            if (currentValue !== defaultValue && currentValue !== null) {
              searchField[fieldName] = currentValue;
            }
          }
        });

        // make new url with field search
        var currentUrl = window.location.href;
        var searchParams = $.param(searchField);

        // Merge query string of current URL with new query string
        queryString += advancedSearch.mergeQueryStrings(advancedSearch.getQueryString(currentUrl), searchParams);
        queryString = queryString.substring("0", queryString.length - 1);

        window.location.href = searchUrl + queryString;
      });
    },
    executeAdvancedSearchInMobile: function () {
      $(
        ".mobile .tfre-advanced-search-btn,.mobile .tf-advanced-search-btn",
        classWrap
      ).on("click", function (e) {
        e.preventDefault();
        var searchForm = $(this).closest(".search-properties-form"),
          searchUrl = searchForm.data("href"),
          searchField = [],
          queryString = "?";
        // loop all field search
        $('.search-form-content .search-field, .tf-search-condition-tab .search-field, .search-more-options .search-field').each(function () {
          var $this = $(this),
            fieldName = $this.attr('name'),
            currentValue = $this.val(),
            defaultValue = $this.data('default-value');

          if (typeof fieldName !== 'undefined') {
            // check has value
            if (currentValue !== defaultValue && currentValue !== null) {
              searchField[fieldName] = currentValue;
            }
          }
        });

        // make new url with field search
        var currentUrl = window.location.href;
        var searchParams = $.param(searchField);

        // Merge query string of current URL with new query string
        queryString += advancedSearch.mergeQueryStrings(advancedSearch.getQueryString(currentUrl), searchParams);
        queryString = queryString.substring("0", queryString.length - 1);

        window.location.href = searchUrl + queryString;
      });
    },
    getQueryString: function (url) {
      var startIndex = url.indexOf("?");
      return startIndex !== -1 ? url.slice(startIndex + 1) : '';
    },
    mergeQueryStrings: function (existingQueryString, newQueryString) {
      var mergedQueryString = existingQueryString;

      // split current query string to pairs key-value
      var existingParams = existingQueryString.split('&');

      // split new query string to pairs key-value
      var newParams = newQueryString.split('&');

      // create object to save key-value from new query string
      var newParamsObj = {};
      newParams.forEach(function (param) {
        var pair = param.split('=');
        newParamsObj[pair[0]] = pair[1];
      });

      // check each pairs key-value of new query string
      // if not exits key in current query string then add key
      newParams.forEach(function (param) {
        var pair = param.split('=');
        var key = pair[0];

        if (!existingParams.some(function (existingParam) {
          return existingParam.startsWith(key + '=');
        })) {
          if (mergedQueryString !== '') {
            mergedQueryString += '&';
          }
          mergedQueryString += param;
        }
      });

      return mergedQueryString;
    },
    showHideSearchFieldFeatures: function () {
      $(".features-wrap .btn-enable-features", classWrap).on(
        "click",
        function (event) {
          event.preventDefault();
          $(".features-list", classWrap).slideToggle();
          $(this).toggleClass("show");
          if ($(this).hasClass("show")) {
            $('input[name="enable-search-features"]', classWrap).attr(
              "value",
              "1"
            );
            $(this).find("i").removeClass("fa-chevron-down");
            $(this).find("i").addClass("fa-chevron-up");
          } else {
            $('input[name="enable-search-features"]', classWrap).attr(
              "value",
              "0"
            );
            $(this).find("i").removeClass("fa-chevron-up");
            $(this).find("i").addClass("fa-chevron-down");
          }
        }
      );
    },
    onClickedStatusFilter: function () {
      advancedSearch.onLoadStatusFilter();
      $(".btn-status-filter", classWrap).on("click", function (e) {
        e.preventDefault();
        var status = $(this).data("value");
        $(this).parent().find('input[name="status"]').val(status);
        $(this).parent().find("button, a").removeClass("active");
        $(this).addClass("active");
      });
    },
    onLoadStatusFilter: function () {
      var $this = $(".btn-status-filter.active"),
        status = $this.data("value");
      $this.parent().find('input[name="status"]').val(status);
    },
    onClickedSearchMore: function () {
      $(".pull-right .tf-search-more-btn").click(function (event) {
        event.preventDefault();
        $(this)
          .parent()
          .parent()
          .parent()
          .find(".tf-search-form-bottom.desktop")
          .slideToggle();
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
          $(this).find(".icon-search-more-white").hide();
          $(this).find(".icon-search-more-black").show();
        } else {
          $(this).find(".icon-search-more-white").show();
          $(this).find(".icon-search-more-black").hide();
        }
      });
    },
    onClickedShowProperties: function () {
      $(".btn-show-properties.tf-search-more-btn").click(function (event) {
        event.preventDefault();
        var $this = $('.pull-right .tf-search-more-btn');
        $this.parent()
          .parent()
          .parent()
          .find(".tf-search-form-bottom.desktop")
          .slideToggle();
        $this.toggleClass("active");
        if ($this.hasClass("active")) {
          $this.find(".icon-search-more-white").hide();
          $this.find(".icon-search-more-black").show();
        } else {
          $this.find(".icon-search-more-white").show();
          $this.find(".icon-search-more-black").hide();
        }
      });
    },
    onClickedSearchMoreMobile: function () {
      $(".mobile .tf-search-more-btn").click(function (event) {
        event.preventDefault();
        $(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .find(".tf-search-form-bottom.mobile")
          .slideToggle();
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
          $(this).find(".icon-search-more-white").hide();
          $(this).find(".icon-search-more-black").show();
        } else {
          $(this).find(".icon-search-more-white").show();
          $(this).find(".icon-search-more-black").hide();
        }
      });
    },
    onToggleSearchFieldFeatures: function () {
      $(".features-wrap .btn-enable-features").click(function (event) {
        event.preventDefault();
        $(".features-wrap .features-list").slideToggle();
        $(this).toggleClass("show");
        if ($(this).hasClass("show") == true) {
          $('input[name="enable-search-features"]').attr("value", "1");
          $(this).find("i").removeClass("fa-chevron-down");
          $(this).find("i").addClass("fa-chevron-up");
        } else {
          $('input[name="enable-search-features"]').attr("value", "0");
          $(this).find("i").removeClass("fa-chevron-up");
          $(this).find("i").addClass("fa-chevron-down");
        }
      });
    },
    checkValidationSaveAdvancedSearchForm: function () {
      var $form = $("#tfre_save_search_form");
      $form.validate({
        errorElement: "div",
        rules: {
          title: {
            required: true,
            minlength: 3,
          },
        },
        messages: {
          title: "This field is required",
        },
      });
    },
    onClickSaveAdvancedSearch: function () {
      $("#tfre_save_search").click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $form = $("#tfre_save_search_form");
        if ($form.valid()) {
          $.ajax({
            url: ajaxUrl,
            data: $form.serialize(),
            method: $form.attr("method"),
            dataType: "JSON",
            beforeSend: function () {
              $this.children("i").remove();
              $this.append(' <i class="fa fa-spinner fa-spin"></i>');
            },
            success: function (response) {
              if (response.success) {
                $this.children("i").removeClass("fa-spinner fa-spin");
                $this.children("i").addClass("fa-check");
                $("#save_search_advanced_modal").modal("hide");
                $form.trigger("reset");
              }
            },
            error: function () {
              $this.children("i").removeClass("fa-spinner fa-spin");
              $this.children("i").addClass("fa-exclamation-triangle");
            },
            complete: function () {
              $this.children("i").removeClass("fa-spinner fa-spin");
            },
          });
        }
      });
    },
    onToggleSearchPropertySidebar: function () {
      var wpadminbar = $("#wpadminbar").height();
      var wrapper = $(".search-properties-sidebar-wrapper");
      var overlay = $(".overlay-search-properties-sidebar");

      $(document).on("click", function (e) {
        if ($(e.target).closest(".tf-search-properties-sidebar-btn").length) {
          wrapper.toggleClass("active");
          wrapper.show();
          overlay.show();
          if (wpadminbar) {
            wrapper.css({ top: wpadminbar });
          }
        } else if (
          !$(e.target).closest(".search-properties-sidebar-wrapper").length ||
          $(e.target).closest(".close-search-properties-sidebar").length
        ) {
          wrapper.removeClass("active");
          wrapper.hide();
          overlay.hide();
        }
      });
    },
    onCheckDisplaySearchForm: function () {
      var win = $(window);
      if (win.width() <= 720) {
        $(".tf-search-wrap")
          .not(".style3")
          .find(".tf-search-form")
          .find(".tf-search-form-top")
          .addClass("row");
      } else {
        $(".tf-search-wrap")
          .not(".style3")
          .find(".tf-search-form")
          .find(".tf-search-form-top")
          .removeClass("row");
      }

      if (win.width() >= 420) {
        $(".tf-search-wrap")
          .not(".style3")
          .find(".tf-search-form")
          .find(".tf-search-form-bottom.mobile")
          .hide();
      } else {
        $(".tf-search-wrap")
          .not(".style3")
          .find(".tf-search-form")
          .find(".tf-search-form-bottom.desktop")
          .hide();
      }
    },
  };

  if (advancedSearchVars.inElementor) {
    $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
        "frontend/element_ready/tf_search_property.default",
        function () {
          advancedSearch.init();
          advancedSearch.onToggleSearchFieldFeatures();
          advancedSearch.onClickedStatusFilter();
          advancedSearch.onToggleSearchPropertySidebar();
          advancedSearch.onCheckDisplaySearchForm();
          $(window).on("resize", function () {
            advancedSearch.onCheckDisplaySearchForm();
          });
        }
      );
    });
  } else {
    $(document).ready(function () {
      advancedSearch.init();
      advancedSearch.onClickedShowProperties();
      advancedSearch.onClickedSearchMore();
      advancedSearch.onClickedSearchMoreMobile();
      advancedSearch.onClickedStatusFilter();
      advancedSearch.onCheckDisplaySearchForm();
      $(window).on("resize", function () {
        advancedSearch.onCheckDisplaySearchForm();
      });
    });
  }
})(jQuery);
