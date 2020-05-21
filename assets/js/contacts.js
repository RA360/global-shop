// Yandex maps
ymaps.ready(() => {
  // Coordinates
  const coords = [
    { coord: [43.684345, -79.431292], title: "Canada" },
    { coord: [40.66817, -73.97907], title: "USA" },
    { coord: [-33.873603, 151.211858], title: "Australia" },
    { coord: [30.065993, 31.266061], title: "Egypt" },
    { coord: [25.195128, 55.27846], title: "Dubai" },
  ];
  // Map init
  const map = new ymaps.Map("map", {
    zoom: 11,
    center: coords[0].coord,
    controls: [],
  });
  // Set mark image for coordinates
  coords.forEach((e) =>
    map.geoObjects.add(
      new ymaps.Placemark(
        e.coord,
        {},
        {
          iconLayout: "default#image",
          iconImageHref: "assets/img/mark.png",
          iconImageSize: [46, 46],
          iconImageOffset: [-22, -28],
        }
      )
    )
  );
  // Insert map buttons
  document.querySelector("#mapBtns").innerHTML = coords
    .map(
      (e, i) =>
        `<button class="map-btn ${
          !i ? "active" : ""
        }" data-coord="${JSON.stringify(e.coord)}">${e.title}</button>`
    )
    .join("");
  // By clicking on the buttons, set the center of the map
  document.querySelectorAll(".map-btn").forEach((e) => {
    e.addEventListener("click", () => {
      document.querySelector(".map-btn.active").classList.remove("active");
      e.classList.add("active");
      map.setCenter(JSON.parse(e.dataset.coord));
    });
  });
});
