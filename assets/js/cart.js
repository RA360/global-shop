const cart = document.querySelector("#cart");
// Insert loading animation
document.body.classList.add("full-height");
cart.innerHTML =
  '<div class="spinner center"><div class="rect"></div><div class="rect rect_2"></div><div class="rect rect_3"></div><div class="rect rect_4"></div><div class="rect rect_5"></div></div>';

const insertEmptyCart = () => {
  document.body.classList.add("full-height");
  cart.innerHTML =
    '<div class="cart__empty center"><img src="../assets/img/empty.png" alt=""><p class="cart__not-found not-found">Your cart is currently empty.</p></div>';
};

let cartGoods = JSON.parse(localStorage.getItem("goods"));
if (cartGoods) {
  // Ajax post cartGoods array for returning goods from db
  fetch("ajax/cartGoods", {
    method: "POST",
    body: JSON.stringify(cartGoods),
  })
    .then((data) => data.text())
    .then((data) => {
      // Insert cart goods
      document.body.classList.remove("full-height");
      cart.innerHTML = data;

      const grandTotalNum = document.querySelector("#grandTotalNum");
      const checkAndCalculate = (parent) => {
        const quantityNum = parent.querySelector(".quantity__num"),
          decrease = parent.querySelector(".js-decrease"),
          increase = parent.querySelector(".js-increase");
        // If quantity value < goods quantity then not disabled quantity buttons
        if (+quantityNum.value < +quantityNum.dataset.quantity) {
          increase.disabled = false;
          decrease.disabled = false;
          if (+quantityNum.value == 1) decrease.disabled = true;
        } else {
          quantityNum.value = quantityNum.dataset.quantity;
          increase.disabled = true;
        }
        // Set goods total price
        parent.querySelector(".js-total").textContent = +(
          +parent.querySelector(".js-price").textContent * +quantityNum.value
        ).toFixed(2);
        // Set grand total price
        grandTotalNum.textContent = [
          ...document.querySelectorAll(".js-total"),
        ].reduce((sum, t) => +(sum + +t.textContent).toFixed(2), 0);
      };

      document.querySelectorAll(".quantity__btn").forEach((e) => {
        e.addEventListener("click", () => {
          const parent = e.parentNode.parentNode.parentNode,
            quantityNum = parent.querySelector(".quantity__num");
          // Increase or decrease depends on which button is pressed
          e.classList.contains("js-decrease")
            ? (quantityNum.value = +quantityNum.value - 1)
            : (quantityNum.value = +quantityNum.value + 1);
          checkAndCalculate(parent);
        });
      });

      document.querySelectorAll(".quantity__num").forEach((e) => {
        e.addEventListener("input", () => {
          const val = e.value;
          // Don't allow the user to enter not a number
          e.value = val.replace(/[^\d]/g, "");
          if (val[0] == 0) e.value = val.substr(1);
          else if (val == "") e.value = 1;
          else checkAndCalculate(e.parentNode.parentNode.parentNode);
        });
      });

      document.querySelectorAll(".cart__delete").forEach((e) => {
        e.addEventListener("click", () => {
          const parent = e.parentNode.parentNode;
          // Remove goods from cartGoods array
          cartGoods = cartGoods.filter((obj) => !obj[parent.dataset.goodsId]);
          // Then if cartGoods array not empty
          if (cartGoods.length) {
            // Set remaining goods
            localStorage.setItem("goods", JSON.stringify(cartGoods));
            // Set grand total price
            grandTotalNum.textContent = +(
              +grandTotalNum.textContent -
              +parent.querySelector(".js-total").textContent
            ).toFixed(2);
            // Set titles for first cart box
            if (parent == document.querySelectorAll(".cart__box")[0])
              ["Price", "Qty", "Total", "Delete"].forEach((e, i) =>
                document
                  .querySelectorAll(".cart__box")[1]
                  .querySelectorAll(".cart__group")
                  [i].insertAdjacentHTML(
                    "afterbegin",
                    `<h4 class="cart__title">${e}</h4>`
                  )
              );
            // Finally remove goods from page
            parent.remove();
          } else {
            localStorage.removeItem("goods");
            insertEmptyCart();
          }
        });
      });

      document.querySelector("#checkout").addEventListener("click", () => {
        const orderOverlay = document.createElement("div");
        orderOverlay.className = "order-overlay";
        orderOverlay.innerHTML = `<div class="order popup center">
                                   <button class="close" id="orderClose"></button>
                                   <form id="orderForm">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" placeholder="example@domain.com" required />
                                    <p class="error" id="orderErr"></p>
                                    <button class="submit black-btn" type="submit">Send payment details</button>
                                   </form>
                                  </div>`;
        document.body.classList.add("full-height");
        document.body.appendChild(orderOverlay);

        const setBlur = (val) =>
          document
            .querySelectorAll("body>*:not(.order-overlay)")
            .forEach((e) => (e.style.filter = val));
        setBlur("blur(2px)");

        document.querySelector("#orderClose").addEventListener("click", (e) => {
          setBlur("none");
          document.body.classList.remove("full-height");
          e.target.parentNode.parentNode.remove();
        });

        document.querySelector("#orderForm").addEventListener("submit", (e) => {
          e.preventDefault();
          // Ajax post form data for sending payment details
          fetch("ajax/order", {
            method: "POST",
            body: new FormData(e.target),
          })
            .then((data) => data.json())
            .then((data) => {
              if (data.error)
                document.querySelector("#orderErr").textContent = data.txt;
              else {
                localStorage.removeItem("goods");
                insertEmptyCart();
                const orderSuccess = document.createElement("p");
                orderSuccess.className = "success";
                orderSuccess.textContent = data.txt;
                e.target.parentNode.replaceChild(orderSuccess, e.target);
              }
            });
        });
      });
    });
} else insertEmptyCart();
