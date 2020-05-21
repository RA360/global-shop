const searchBtn = document.querySelector("#searchBtn"),
  searchI = document.querySelector("#searchI"),
  suggests = document.querySelector("#suggests"),
  basketGoods = JSON.parse(localStorage.getItem("goods"));
const getCookie = (name) => {
  const matches = document.cookie.match(
    new RegExp(
      `(?:^|; )${name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1")}=([^;]*)`
    )
  );
  return matches ? decodeURIComponent(matches[1]) : undefined;
};

// Insert basket goods count
if (basketGoods)
  document.querySelector("#basketCount").textContent = basketGoods.length;

// Show city popup
if (!getCookie("city")) {
  if (navigator.geolocation) {
    const showCityPopup = (locality) => {
      // Inner city popup
      const city = document.createElement("div");
      city.className = "city popup";
      city.id = "city";
      city.innerHTML = `<button class="city__close close" id="cityClose"></button>
                     <div id="cityBox">
                       <p class="city__txt">
                         Your city – <span class="city__name" id="cityName">${locality}?</span>
                       </p>
                       <div class="city__btns">
                         <button class="city__agree agree" id="cityAgree">Yes</button>
                         <button class="city__another" id="cityAnother">Another city</button>
                       </div>
                       <p class="city__hint">
                         Availability of goods, methods and delivery time depend on the selected city.
                       </p>
                     </div>`;
      document.body.appendChild(city);

      const setCityInCookie = (name) => {
        const date = new Date();
        date.setMonth(date.getMonth() + 24);
        document.cookie = `city=${name};expires=${date}`;
      };
      const removeCityPopup = () => {
        const city = document.querySelector("#city");
        city.classList.add("hide");
        setTimeout(() => {
          city.remove();
        }, 1000);
      };
      // Add script for cities suggest from yandex
      const script = document.createElement("script");
      script.src =
        "https://api-maps.yandex.ru/2.1/?lang=en_US&load=SuggestView";
      document.head.appendChild(script);

      const cityClose = document.querySelector("#cityClose"),
        cityBox = document.querySelector("#cityBox");
      // If user agree with city which we suggest based on ajax
      document.querySelector("#cityAgree").addEventListener("click", () => {
        setCityInCookie(locality);
        cityBox.innerHTML = `<p class="city__success city__txt">
                              Now you see goods with the availability, ways and delivery time for ${locality}
                            </p>`;
        const setRemovePopupTime = setTimeout(() => removeCityPopup(), 15000);
        cityClose.addEventListener("click", () =>
          clearTimeout(setRemovePopupTime)
        );
      });

      document.querySelector("#cityAnother").addEventListener("click", () => {
        cityBox.innerHTML = `<input class="city__input input" id="cityI" placeholder="Enter a city.." />
                             <p class="city__hint">Click on suggestion.</p>`;
        // Init suggestView based on input value
        const suggestView = new ymaps.SuggestView("cityI");
        // If user click on suggest view
        suggestView.events.add("select", (e) => {
          setCityInCookie(e.get("item").value);
          removeCityPopup();
        });
      });
      // Remove city popup
      cityClose.addEventListener("click", () => {
        setCityInCookie(locality);
        removeCityPopup();
      });
    };
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        fetch(
          `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${pos.coords.latitude}&longitude=${pos.coords.longitude}`
        )
          .then((data) => data.json())
          .then(({ locality }) => showCityPopup(locality));
      },
      () => {
        fetch("https://ipinfo.io?token=f30c8c76005471")
          .then((data) => data.json())
          .then(({ city }) => {
            if (city) showCityPopup(city);
          });
      }
    );
  }
}

// Notify users about cookie
if (!sessionStorage.getItem("cookie")) {
  const cookie = document.createElement("div");
  cookie.className = "cookie popup";
  cookie.innerHTML = `<div>
                        <p class="cookie__title">Global Shop and Cookies</p>
                        <p class="cookie__info">This site uses cookies. By clicking ACCEPT or continuing to browse the site you are agreeing to our use of cookies. <a class="cookie__link" href="https://ru.wikipedia.org/wiki/Cookie" target="_blank">Find out more here</a>.</p>
                      </div>
                      <button class="cookie__agree agree" id="cookieAgree">Accept</button>`;
  document.body.appendChild(cookie);
  // Hide cookie notice
  document.querySelector("#cookieAgree").addEventListener("click", (e) => {
    e.target.parentNode.style.bottom = "-999px";
    sessionStorage.setItem("cookie", "accept");
    setTimeout(() => e.target.parentNode.remove(), 2000);
  });
}

document.querySelector("#hamburger").addEventListener("click", function () {
  // Toggle dropdown
  this.classList.toggle("open");
  document.querySelector("#dropdown").classList.toggle("visible");
});

searchBtn.addEventListener("click", () => {
  const title = document.querySelector("#title");
  suggests.textContent = "";
  searchI.classList.toggle("visible");
  title.classList.toggle("hidden");
  const closeSearch = (e) => {
    // If clicked not search input or button, close search input
    if (e.target != searchI && e.target != searchBtn) {
      suggests.textContent = "";
      searchI.classList.remove("visible");
      title.classList.remove("hidden");
      document.removeEventListener("click", closeSearch);
    }
  };
  document.addEventListener("click", closeSearch);
});

searchI.addEventListener("input", (e) => {
  const val = e.target.value.trim();
  // If search value not empty ajax post and return suggests
  if (val != "") {
    fetch("ajax/searchGoods", {
      method: "POST",
      body: val,
    })
      .then((data) => data.text())
      .then((data) => (suggests.innerHTML = data));
  }
});
