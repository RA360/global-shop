const sliderDots = document.querySelectorAll(".slider__dot");
let index = 0;
const goToSlide = (n) => {
  const slides = document.querySelectorAll(".slide");
  // Find current index of slide
  index = (n + slides.length) % slides.length;
  document.querySelector(".slide.active").classList.remove("active");
  // Display current slide
  slides[index].classList.add("active");
  // Anchor link depends on the current slide
  document.querySelector(
    "#showBtns"
  ).href = `detail?id=${slides[index].dataset.goodsId}`;
  document.querySelector(".slider__dot.active").classList.remove("active");
  sliderDots[index].classList.add("active");
};

document
  .querySelector("#sliderPrev")
  .addEventListener("click", () => goToSlide(index - 1));

document
  .querySelector("#sliderNext")
  .addEventListener("click", () => goToSlide(index + 1));

sliderDots.forEach((e) =>
  e.addEventListener("click", () => goToSlide(+e.textContent - 1))
);

// For two and more sliders
// document.querySelectorAll(".slider").forEach((e) => {
//   const slides = e.querySelectorAll(".slide"),
//     sliderDots = e.querySelectorAll(".slider__dot");
//   let index = 0;
//   const goToSlide = (n) => {
//     slides[index].className = "slide";
//     index = (n + slides.length) % slides.length;
//     slides[index].classList.add("active");
//     e.querySelector(".slider__dot.active").classList.remove("active");
//     sliderDots[index].classList.add("active");
//   };
//   e.querySelector(".slider__next").addEventListener("click", () =>
//     goToSlide(index + 1)
//   );
//   e.querySelector(".slider__prev").addEventListener("click", () =>
//     goToSlide(index - 1)
//   );
//   sliderDots.forEach((d) =>
//     d.addEventListener("click", () => goToSlide(+d.textContent - 1))
//   );
// });

document.querySelectorAll(".play").forEach((e) =>
  e.addEventListener(
    "click",
    () =>
      // Insert the video and play it automatically
      (e.parentNode.innerHTML = `<video src="assets/videos/${e.dataset.video}" type="video/mp4" autoplay controls></video>`)
  )
);

const query = {
  cat: "headphones",
  sort: "`id` DESC",
};
const fetchGoods = () => {
  const goodsList = document.querySelector("#goodsList");
  // Insert loading animation
  goodsList.innerHTML =
    '<div class="spinner center"><div class="rect"></div><div class="rect rect_2"></div><div class="rect rect_3"></div><div class="rect rect_4"></div><div class="rect rect_5"></div></div>';
  // Ajax post query for returning goods from db
  fetch("ajax/homeGoods", {
    method: "POST",
    body: `WHERE \`category\` = '${query.cat}' ${
      query.color ? `AND \`color\` = '${query.color}'` : ""
    } ORDER BY ${query.sort ? query.sort : ""}`,
  })
    .then((data) => data.text())
    .then((data) =>
      data == ""
        ? (goodsList.innerHTML =
            '<p class="not-found center">No products found</p>')
        : (goodsList.innerHTML = data)
    );
};

fetchGoods();

document.querySelectorAll(".sorts_cat .sort").forEach((e) => {
  e.addEventListener("click", () => {
    e.parentNode.querySelector(".sort.active").classList.remove("active");
    e.classList.add("active");
    query.cat = e.dataset.cat;
    fetchGoods();
  });
  e.addEventListener("mouseover", () => {
    e.parentNode.querySelector(".sort.active").style.opacity = 0.6;
    e.style.opacity = 1;
  });
  e.addEventListener("mouseout", () => {
    if (!e.classList.contains("active")) {
      e.parentNode.querySelector(".sort.active").style.opacity = 1;
      e.style.opacity = 0.6;
    }
  });
});

document.querySelectorAll(".sorts_color .sort").forEach((e) => {
  e.addEventListener("click", () => {
    const activeSort = e.parentNode.querySelector(".sort.active");
    if (e.classList.contains("active")) delete query.color;
    else {
      query.color = e.dataset.color;
      if (activeSort) activeSort.classList.remove("active");
    }
    e.classList.toggle("active");
    fetchGoods();
  });
});

document.querySelector("#goodsSel").addEventListener("change", (e) => {
  switch (e.target.value) {
    case "ascending":
      query.sort = "`price` ASC";
      break;
    case "descending":
      query.sort = "`price` DESC";
      break;
    default:
      query.sort = "`id` DESC";
  }
  fetchGoods();
});
