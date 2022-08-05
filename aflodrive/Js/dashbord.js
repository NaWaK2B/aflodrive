let tabs = document.querySelectorAll(".tabs__toggle");
content = document.querySelectorAll(".tabs__content");

tabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    content.forEach((content) => {
      content.classList.remove("is-active");
    });

    tabs.forEach((tabs) => {
      tabs.classList.remove("is-active");
    });

    content[index].classList.add("is-active");
    tabs[index].classList.add("is-active");
  });
});
