"use strict";

$.fn.replaceClass = function(oldClass, newClass) {
  return this.removeClass(oldClass).addClass(newClass);
};

function currencyFormat() {
  $(event.target).val(function(index, number) {
    number = number.replace(/[\D]+/g, "");

    if (number === "") {
      return 0;
    }

    number = BigInt(number.replace(/[\.]+/g, ""));

    number = new Intl.NumberFormat("id-ID").format(BigInt(number));

    return number;
  })
}

function showPassword() {
  const toggler = $(event.target);
  const target = $(toggler).prev();

  if ($(target).attr("type") === "text") {
    $(target).attr("type", "password");
    $(toggler).children().replaceClass("bi-eye", "bi-eye-slash");
  } else {
    $(target).attr("type", "text");
    $(toggler).children().replaceClass("bi-eye-slash", "bi-eye");
  }
}

function tableToCSV(name, title, timestamp) {
  $("#reportTable").tableToCsv({
    filename: `Laporan ${name}_${title}_${timestamp}.csv`,
    separator: ";"
  });
}

function tableToExcel(name, title, timestamp) {
  TableToExcel.convert(document.getElementById("reportTable"), {
    name: `Laporan ${name}_${title}_${timestamp}.xlsx`,
    sheet: {
      name: "Sheet 1"
    }
  });
}

function tableToPDF(name, title, timestamp) {
  html2pdf(document.getElementById("reportPage"), {
    filename: `Laporan ${name}_${title}_${timestamp}.pdf`,
    html2canvas: {
      scale: 4
    },
    image: {
      quality: 1,
      type: "jpeg"
    },
  });
}

function telFormat() {
  $(event.target).val(function(index, tel) {
    return tel.replace(/[\D]+/g, "");
  })
}

$(document).on("scroll", function() {
  if ($(document).scrollTop() > 20) {
    $("#scrollToTop").fadeIn("fast");
  } else {
    $("#scrollToTop").fadeOut("fast");
  }
});

AOS.init({
  duration: 500,
  easing: "ease-in-out-quart",
  once: true
});

$("#dataTable").DataTable({
  fixedColumns: true,
  language: {
    url: "/assets/json/dataTables.i18n.id.json"
  },
  scrollX: true,
});