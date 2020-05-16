/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

jQuery(function($) {
  "use strict";

  $(document)
    .on("click", ".btn-group label:not(.active)", function() {
      var $label = $(this);
      var $input = $("#" + $label.attr("for"));

      if ($input.prop("checked")) {
        return;
      }

      $label
        .closest(".btn-group")
        .find("label")
        .removeClass("active btn-success btn-danger btn-primary");

      var btnClass = "primary";

      if ($input.val() != "") {
        var reversed = $label
          .closest(".btn-group")
          .hasClass("btn-group-reversed");
        btnClass = ($input.val() == 0
        ? !reversed
        : reversed)
          ? "danger"
          : "success";
      }

      $label.addClass("active btn-" + btnClass);
      $input.prop("checked", true).trigger("change");
    })
    .on("click", "#back-top", function(e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, 1000);
    })
    .on("subform-row-add", initButtonGroup)
    .on("subform-row-add", initTooltip);

  initButtonGroup();
  initTooltip();

  // Called once on domready, again when a subform row is added
  function initTooltip(event, container) {
    $(container || document)
      .find("*[rel=tooltip]")
      .tooltip();
  }

  // Called once on domready, again when a subform row is added
  function initButtonGroup(event, container) {
    var $container = $(container || document);

    // Turn radios into btn-group
    $container.find(".radio.btn-group label").addClass("btn");

    $container.find(".btn-group input:checked").each(function() {
      var $input = $(this);
      var $label = $("label[for=" + $input.attr("id") + "]");
      var btnClass = "primary";

      if ($input.val() != "") {
        var reversed = $input.parent().hasClass("btn-group-reversed");
        btnClass = ($input.val() == 0
        ? !reversed
        : reversed)
          ? "danger"
          : "success";
      }

      $label.addClass("active btn-" + btnClass);
    });
  }
});

// DW
(function($) {
  $(document).ready(function() {
    //sppb - add normal BT Classes [different then sections]
    $('[class^="sppb-"]').each(function() {
      var cls = $(this).attr("class");
      cls = cls.replace(/sppb-/g, "");

      if (cls.indexOf("section") < 0) {
        $(this).addClass(cls);
      }
    });

    // svg image
    $('img[src$=".svg"]').each(function() {
      var $img = jQuery(this);
      var imgURL = $img.attr("src");
      var attributes = $img.prop("attributes");

      $.get(
        imgURL,
        function(data) {
          // Get the SVG tag, ignore the rest
          var $svg = jQuery(data).find("svg");

          // Remove any invalid XML tags
          $svg = $svg.removeAttr("xmlns:a");

          // Loop through IMG attributes and apply on SVG
          $.each(attributes, function() {
            $svg.attr(this.name, this.value);
          });

          // Replace IMG with SVG
          $img.replaceWith($svg);
        },
        "xml"
      );
    });

    $("#offcanvas-toggler").on("click", function() {
      $("body").toggleClass("offcanvas-opened");
      $(this).toggleClass("active");
      $(".main-menu").toggleClass("active");
    });
    var references = new Swiper(
      ".references-swiper-container .swiper-container",
      {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
          nextEl: ".references-swiper-container .swiper-button-next",
          prevEl: ".references-swiper-container .swiper-button-prev"
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      }
    );

    var logos = new Swiper(".logos-swiper-container .swiper-container", {
      slidesPerView: 6,
      spaceBetween: 15,
      loop: true,
      navigation: {
        nextEl: ".logos-swiper-container .swiper-button-next",
        prevEl: ".logos-swiper-container .swiper-button-prev"
      },
      breakpoints: {
        // when window width is <= 320px
        480: {
          slidesPerView: 1,
          spaceBetween: 10
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 10
        },
        991: {
          slidesPerView: 3,
          spaceBetween: 10
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 10
        }
      }
    });

    stickyHeader();
  });

  // if press esc then menu will be close
  $(document).on("keyup", function(e) {
    if (e.keyCode == 27) {
      $(".menu-bar").removeClass("active");
      $(".main-menu").removeClass("active");
      $("body").removeClass("offcanvas-opened");
    }
  });

  $(window).load(function() {
    $(".service_item-img").each(function() {
      var height = $(this).height();
      var width = $(this).width();

      $("img", $(this)).css("min-width", width);
      $("img", $(this)).css("min-height", height);
    });
  });

  $(window).scroll(function(){
    stickyHeader();
  });

  function stickyHeader(){
    var header = $('.header'),
    scroll = $(window).scrollTop();

    if (scroll > 0) header.addClass('sticky');
    else header.removeClass('sticky');
  }

  $(document).off('click', '[data-scroll-to="true"], .sppb-menu-scroll').on("click", '[data-scroll-to="true"], .sppb-menu-scroll', function(e) {
    e.preventDefault();
    var i = $(this).attr("href"),
        n = $(this).parents(".sppb-link-list-wrap"),
        s = $(this).parents(".sppb-link-list-wrap").data("offset");
    (s = void 0 === s || "" === s ? 0 : parseInt(s)) < 0 ? s = Math.abs(s) : s *= -1, n.find(".sppb-active").removeClass("sppb-active"), $(this).parent().addClass("sppb-active"), $("html, body").animate({
        scrollTop: $(i).offset().top + s - 80
    }, 600)
})
})(jQuery);

