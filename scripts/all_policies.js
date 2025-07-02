/*  policies_list.js
 *  Requires: jQuery + SweetAlert2 (for gentle error popups)
 *
 *  Expected HTML tweaks:
 *    – UL container  : <ul id="policy-list" class="row"></ul>
 *    – Search input  : <input type="text" id="policySearch" …>
 *    – Remove ALL hard‑coded <li> cards; JS will inject them.
 */

$(function () {

    
  /* SETTINGS */
  const pageSize = 9;               // cards per page

  /* wait until cards are rendered by policies_list.js */
  $(document).on("cards:ready", function () {
    paginate();
  });

  /* re‑paginate after search filter */
  $("#policySearch").on("input", function () {
    paginate();
  });

  function paginate() {
    const $cards = $(".policy-card:visible");
    const total  = $cards.length;
    const pages  = Math.ceil(total / pageSize) || 1;
    const $pager = $("#pager").empty();

    /* if only one page, hide pagination */
    if (pages <= 1) return;

    // helper to build a button
    const btn = (label, page, disabled = false, current = false) =>
      $(`<a href='#' class='btn ${current ? "btn-primary current" : "btn-outline-primary"} ${disabled ? "disabled" : ""}' data-page='${page}'>${label}</a>`);

    /* PREV */
    $pager.append(btn("<i class='fa fa-angle-double-left'></i>", 1, true).addClass("prev"));

    /* Page numbers */
    for (let i = 1; i <= pages; i++) {
      $pager.append(btn(i, i, false, i === 1));
    }

    /* NEXT */
    $pager.append(btn("<i class='fa fa-angle-double-right'></i>", pages, true).addClass("next"));

    showPage(1);

    /* click handler */
    $pager.find("a").off("click").on("click", function (e) {
      e.preventDefault();
      if ($(this).hasClass("disabled")) return;
      const page = +$(this).data("page");
      showPage(page);
    });
  }

  function showPage(page) {
    const $cards = $(".policy-card:visible");
    const start  = (page - 1) * pageSize;
    const end    = start + pageSize - 1;

    $cards.each(function (idx) {
      $(this).toggle(idx >= start && idx <= end);
    });

    /* update active button */
    $("#pager a").removeClass("btn-primary current")
                 .addClass("btn-outline-primary");
    $(`#pager a[data-page='${page}']`)
        .addClass("btn-primary current")
        .removeClass("btn-outline-primary");

    /* enable / disable prev/next */
    $("#pager .prev").toggleClass("disabled", page === 1)
                     .data("page", page - 1);
    $("#pager .next").toggleClass("disabled", page ===
                                  $("#pager a[data-page]").length)
                     .data("page", page + 1);
  }

  /* Trigger once after policies load */
  $(document).trigger("cards:ready");


  // ─────────────────────────────────────────
  //  FETCH & RENDER
  // ─────────────────────────────────────────
  $.getJSON("../api/api_all_policies.php", function (res) {
    if (!res.success) throw res.message;
    buildCards(res.data);
  }).fail(function (xhr) {
    Swal.fire("Error", xhr.responseText || "Unable to load policies.", "error");
  });

  function buildCards(policies) {
    const $ul = $("#policy-list").empty();           // ensure clean slate
    if (!policies.length) {
      $ul.append("<p class='text-center w-100'>No policies found.</p>");
      return;
    }

    policies.forEach(p => {
      $ul.append(cardTemplate(p));
    });
  }

  function cardTemplate(p) {
  // helper for money
  const money = num => `LKR&nbsp;${(+num).toLocaleString(undefined,{minimumFractionDigits:2})}`;

  const benefitsHTML = p.benefits.map(b => `<li>${b}</li>`).join("");

  return `
  <li class="col-lg-4 col-md-6 col-sm-12 mb-4 policy-card"
      data-name="${p.policy_name.toLowerCase()}">
    <div class="product-box h-100 d-flex flex-column">

      <!-- Top image -->
      <div class="producct-img">
        <img src="../${p.image}" alt="${p.policy_name}"
             style="height:220px;width:100%;object-fit:cover;">
      </div>

      <!-- Caption -->
      <div class="product-caption text-center d-flex flex-column flex-grow-1">

        <h4 class="my-2">
          <a href="../policies/policy-details.php?id=${p.id}">
            ${p.policy_name}
          </a>
        </h4>

        <!-- Optional sub‑text -->
        <div class="contact-name text-center">
          <p class="text-muted"><i>${p.term_years}&nbsp;year term</i></p>
        </div>

        <!-- Price blocks -->
        <div class="price text-center">
          <h6 class="text-muted"><del>${money(p.premium_amount * 1.1)}</del></h6>
          <h3>${money(p.premium_amount)}</h3>
        </div>

        <hr>

        <!-- Benefits -->
        <div class="pricing-card-body flex-grow-1">
          <div class="pricing-points">
            <ul>${benefitsHTML}</ul>
          </div>
        </div>

        <hr>

        <!-- CTA -->
        <div class="d-flex justify-content-center mb-2">
          <a href="../policies/policy-details.php?id=${p.id}"
             class="btn btn-outline-primary">
             Select Now
          </a>
        </div>

      </div><!-- /.product-caption -->
    </div><!-- /.product-box -->
  </li>`;
}


  // ─────────────────────────────────────────
  //  LIVE SEARCH
  // ─────────────────────────────────────────
  $("#policySearch").on("input", function () {
    const q = $(this).val().toLowerCase();
    $(".policy-card").each(function () {
      const match = $(this).data("name").includes(q);
      $(this).toggle(match);
    });
  });


  
});
