window.addEventListener("DOMContentLoaded", () => {
  // Домашняя страница - поиск
  let searchInput = document.querySelector(".search-input");

  if (searchInput) {
    searchInput.addEventListener("change", (event) => {
      if (event.target.value) {
        window.location.href = `index.php?action=search&word=${event.target.value}`;
      }
    });
  }

  // Админка - поиск
  let searchInputAdmin = document.querySelector(".search-input--admin");

  if (searchInputAdmin) {
    searchInputAdmin.addEventListener("change", (event) => {
      if (event.target.value) {
        window.location.href = `../index.php?action=adminSearch&word=${event.target.value}`;
      }
    });
  }

  // Страница с удалением вопросов
  let searchInputDeleteQ = document.querySelector(".search-input--delete-Q");
  let lessonName = document.querySelectorAll(".lesson-name");
  let searchBtn = document.querySelector(".search__wrapper--delete-Q .search__btn");

  if (searchInputDeleteQ) {
    searchInputDeleteQ.addEventListener("change", (event) => {
      if (event.target.value) {
        searchBtn.style.display = "block";
        lessonName.forEach((item) => {
          if (item.textContent.toLowerCase().includes(event.target.value.toLowerCase())) {
            item.nextElementSibling.style.display = "flex";
          }
          if (!item.textContent.toLowerCase().includes(event.target.value.toLowerCase())) {
            item.nextElementSibling.style.display = "none";
            item.style.display = "none";
          }
          if (item.nextElementSibling.textContent.toLowerCase().includes(event.target.value.toLowerCase())) {
            item.nextElementSibling.style.display = "flex";
            item.style.display = "block";
          }
        });
      }
    });
  }
  searchBtn.addEventListener("click", (event) => {
    window.location.href = "index.php?action=deletetest";
  });

  // Больше категорий
  let categoryBtns = document.querySelectorAll(".categories__btn");
  let moreCategoriesBtn = document.querySelector(".categories__more-btn");

  if (categoryBtns.length <= 10 && moreCategoriesBtn) {
    moreCategoriesBtn.style.display = "none";
  }

  if (categoryBtns) {
    categoryBtns.forEach((btn, btnIndex) => {
      if (btnIndex > 9) {
        btn.style.display = "none";
      }
    });
  }

  if (moreCategoriesBtn) {
    moreCategoriesBtn.addEventListener("click", (e) => {
      categoryBtns.forEach((btn, btnIndex) => {
        if (btnIndex > 9) {
          btn.style.display = "flex";
          moreCategoriesBtn.style.display = "flex";
          e.target.style.display = "none";
        }
      });
    });
  }
});
