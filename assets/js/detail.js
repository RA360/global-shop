const detailI = document.querySelector("#detailI");
detailI.addEventListener("input", function () {
  const val = this.value;
  if (val.includes(".")) this.value = val.replace(/[.]/g, "");
  else if (val[0] == 0) this.value = val.substr(1);
  else if (val == "") this.value = 1;
  else if (+val > +this.max) this.value = this.max;
});

document.querySelector("#addToCart").addEventListener("click", (e) => {
  let cartGoods = JSON.parse(localStorage.getItem("goods")) || [];
  const id = e.target.dataset.goodsId;
  // Filter cartGoods array from goods, if it already added
  cartGoods = cartGoods.filter((e) => !e[id]);
  // Add goods(id,count) to cartGoods array
  cartGoods.unshift({ [id]: detailI.value });
  localStorage.setItem("goods", JSON.stringify(cartGoods));
});
