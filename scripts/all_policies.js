/*  policies_list.js
 *  Requires: jQuery + SweetAlert2 (for gentle error popups)
 *
 *  Expected HTML tweaks:
 *    – UL container  : <ul id="policy-list" class="row"></ul>
 *    – Search input  : <input type="text" id="policySearch" …>
 *    – Remove ALL hard‑coded <li> cards; JS will inject them.
 */

$(function () {

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
