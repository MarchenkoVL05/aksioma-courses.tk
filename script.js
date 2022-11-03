window.addEventListener("DOMContentLoaded", () => {
  // Домашняя страница
  let lessonsItemNames = document.querySelectorAll(".lessons__item-name");

  let searchInput = document.querySelector(".search-input");
  let searchCloseBtn = document.querySelector(".search__btn");

  if (searchInput) {
    searchInput.addEventListener("change", (event) => {
      if (event.target.value !== "" && searchCloseBtn) {
        searchCloseBtn.style.display = "block";
      }
      lessonsItemNames.forEach((itemName, itemIndex) => {
        if (!itemName.textContent.toLowerCase().includes(event.target.value.toLowerCase())) {
          itemName.parentNode.style.display = "none";
        }
      });
    });
  }

  // Логику поиска на домашней и административной странице можно переписать в соответствии с DRY

  // Административная страница
  let adminlessonsItemNames = document.querySelectorAll(".admin-lessons__item-name");

  if (searchInput) {
    searchInput.addEventListener("change", (event) => {
      if (event.target.value !== "" && searchCloseBtn) {
        searchCloseBtn.style.display = "block";
      }
      adminlessonsItemNames.forEach((itemName, itemIndex) => {
        if (!itemName.textContent.toLowerCase().includes(event.target.value.toLowerCase())) {
          console.log(itemName.parentNode);
          itemName.parentNode.parentNode.style.display = "none";
        }
      });
    });
  }

  if (searchCloseBtn) {
    searchCloseBtn.addEventListener("click", () => {
      window.location.reload();
    });
  }

  // Больше категорий
  let categoryBtns = document.querySelectorAll(".categories__btn");
  let moreCategoriesBtn = document.querySelector(".categories__more-btn");

  if (categoryBtns.length <= 10) {
    moreCategoriesBtn.style.display = "none";
  }

  categoryBtns.forEach((btn, btnIndex) => {
    if (btnIndex > 9) {
      btn.style.display = "none";
    }
  });

  moreCategoriesBtn.addEventListener("click", (e) => {
    categoryBtns.forEach((btn, btnIndex) => {
      if (btnIndex > 9) {
        btn.style.display = "flex";
        moreCategoriesBtn.style.display = "flex";
        e.target.style.display = "none";
      }
    });
  });
});
