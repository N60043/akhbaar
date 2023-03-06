
// header Item remain ctive after  Page reload
  const headerItem = document.querySelectorAll('#scrollmenu a');
  headerItem.forEach(el => {
    // current
    if (el.getAttribute('href') === (window.location.href || 'CategoryNews')) {
      el.classList.add("activeHeader");
    }

    // handle click
    el.addEventListener("click", e => {
      // remove others
      headerItem.forEach(el => el.classList.remove("activeHeader"))
      // set active
      e.target.classList.add("activeHeader")
    })
  });

  



 



