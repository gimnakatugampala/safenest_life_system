/* policy_details.js – jQuery + SweetAlert2 + Slick slider */
$(function () {
  const id = new URLSearchParams(location.search).get("id");
  if (!id) {
    Swal.fire("Error", "No policy id", "error");
    return;
  }

  /* single AJAX call – returns main policy + recent list */
  $.getJSON(`../api/api_policy_details.php?id=${id}`, res => {
    if (!res.success) {
      Swal.fire("Error", res.message, "error");
      return;
    }
    injectMarkup();          // build HTML skeleton once
    renderPolicy(res);       // gallery + details
    renderRecent(res.recent);// three recent cards
  }).fail(xhr => {
    Swal.fire("Error", xhr.responseText || "Failed to load policy", "error");
  });

  /* ────────────────────────────────────────────
     1. Inject empty structure (now carries id)
  ────────────────────────────────────────────*/
  function injectMarkup() {
    const wrapper = $(".product-detail-wrap");
    if (wrapper.find(".product-slider").length) return;   // already present

    wrapper.html(`
      <div class="row">
        <!-- gallery -->
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="product-slider slider-arrow"></div>
          <div class="product-slider-nav mt-2"></div>
        </div>

        <!-- description / price -->
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="product-detail-desc pd-20 card-box height-100-p">
            <h4 class="mb-20 pt-20"></h4>
            <p class="desc-1"></p><p class="desc-2"></p>

            <div class="price text-center my-2">
              <h6 class="text-muted"><del></del></h6><h3></h3>
            </div>

            <hr>
            <div class="pricing-card-body"><div class="pricing-points"><ul></ul></div></div>
            <hr>

            <div class="row">
              <div class="col-md-12">
                <!-- ✅ id injected here -->
                <a href="../policies/policy-application-form.php?policy_id=${id}"
                   class="btn btn-primary btn-block buy-btn">Apply Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>`);
  }

  /* ────────────────────────────────────────────
     2. Main policy rendering (unchanged)
  ────────────────────────────────────────────*/
  function renderPolicy({ policy, pictures, benefits }) {
    /* title / breadcrumb */
    $(".title h4, .breadcrumb-item.active").text(policy.policy_name);

    /* gallery */
    const $slider = $(".product-slider").empty();
    const $thumbs = $(".product-slider-nav").empty();
    pictures.forEach(src => {
      $slider.append(`<div class="product-slide"><img src="../${src}" alt=""></div>`);
      $thumbs.append(`<div class="product-slide-nav"><img src="../${src}" alt=""></div>`);
    });
    if ($.fn.slick) {
      if ($slider.hasClass("slick-initialized")) $slider.slick("unslick");
      if ($thumbs.hasClass("slick-initialized")) $thumbs.slick("unslick");
      $slider.slick({slidesToShow:1, asNavFor:'.product-slider-nav', arrows:true});
      $thumbs.slick({slidesToShow:4, asNavFor:'.product-slider', focusOnSelect:true, arrows:false});
    }

    /* text + price + benefits */
    $(".product-detail-desc h4").text(policy.policy_name);
    $(".product-detail-desc p.desc-1").text(policy.description);
    $(".price del").text(`LKR ${(policy.premium_amount*1.10)
                           .toLocaleString(undefined,{minimumFractionDigits:2})}`);
    $(".price h3").html(`LKR ${(policy.premium_amount)
                           .toLocaleString(undefined,{minimumFractionDigits:2})}`);
    $(".pricing-points ul").html(benefits.map(b=>`<li>${b}</li>`).join(""));
  }

  /* ────────────────────────────────────────────
     3. Recent (max 3) cards
  ────────────────────────────────────────────*/
  function renderRecent(list = []) {
    const $ul = $("#recent-list").empty();
    list.slice(0,3).forEach(p => $ul.append(recentCard(p)));
  }
  function recentCard(p) {
    const money = n => `LKR ${(n).toLocaleString(undefined,{minimumFractionDigits:2})}`;
    const oldP  = money((+p.premium_amount)*1.10);
    const bList = p.benefits.slice(0,3).map(b=>`<li>${b}</li>`).join("");
    return `
      <li class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="product-box">
          <div class="producct-img"><img src="../${p.image}" alt=""></div>
          <div class="product-caption text-center">
            <h4><a href="policy-details.php?id=${p.id}">${p.policy_name}</a></h4>
            <div class="contact-name text-center"><p>${p.term_years} year term</p></div>
            <div class="price text-center">
              <h6 class="text-muted"><del>${oldP}</del></h6><h3>${money(p.premium_amount)}</h3>
            </div>
            <hr><div class="pricing-card-body"><div class="pricing-points"><ul>${bList}</ul></div></div><hr>
            <div class="d-flex justify-content-center">
              <a href="policy-details.php?id=${p.id}" class="btn btn-outline-primary">Select Now</a>
            </div>
          </div>
        </div>
      </li>`;
  }
});
