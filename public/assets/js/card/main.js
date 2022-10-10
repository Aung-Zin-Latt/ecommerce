const searchBox = document.getElementById("search");
const search_warp = document.getElementById("searchbox");
const alters = document.getElementById("alters");
const name = document.getElementById("name");
const navmeun = document.getElementById("menu_sub");
const submenu = document.querySelector("submenu");

// searchBox.addEventListener("click", () => {
//   if (search_warp.style.display == "none") {
//     search_warp.style.display = "block";
//   } else {
//     search_warp.style.display = "none";
//   }
// });

//submenu
// navmeun.addEventListener("click",()=>{
//     submenu.style.display="block";
// })

// navigator bar
// window.addEventListener("scroll", () => {
//   document
//     .querySelector("nav")
//     .classList.toggle("window-scroll", window.scrollY > 0);
// });

// show hide nav menu

const menu = document.querySelector(".nav_menu");
const menuBtn = document.querySelector("#open-menu-btn");
const closeBtn = document.querySelector("#close-menu-btn");

// menuBtn.addEventListener("click", () => {
//   menu.style.display = "flex";
//   closeBtn.style.display = "inline-block";
//   menuBtn.style.display = "none";
// });

// close nav menu

const closeNav = () => {
  menu.style.display = "none";
  closeBtn.style.display = "none";
  menuBtn.style.display = "inline-block";
};
// closeBtn.addEventListener("click", closeNav);

//show hidden product in makeup page
function seeMore(btn) {
  let post = btn.previousElementSibling;
  // console.log(post);
  post.classList.toggle("open");

  const text = document.querySelector("div h4.seemore-text");
  const icon = document.querySelector(".faq_icon i");
  // btn.previousElementSibling.className === 'foundation-product-container hidden-container hidden-product open' ? console.log('yes') : console.log('no');

  if (
    btn.previousElementSibling.className ==
    "foundation-product-container hidden-container hidden-product open"
  ) {
    btn.innerHTML = `
             <div><h4 class="seemore-text" style="color:#088178">See Less</h4></div>
        <div class="faq_icon" style="color:#088178"><i class="uil uil-minus-circle"></i></div>
         `;
    //  icon.className='uil uil-minus-circle';
    //  text.innerText= 'See Less';
    //  text.style.color ='#088178';
    //  icon.style.color ='#088178';
  } else {
    btn.innerHTML = `
             <div><h4 class="seemore-text" style="color:#A63535">See More</h4></div>
        <div class="faq_icon" style="color:#A63535"><i class="uil uil-plus-circle"></i></div>
         `;
    // icon.className = 'uil uil-plus-circle';
    // text.innerText= 'See More';
    // text.style.color='#A63535';
    // icon.style.color ='#A63535'
  }

  //change icon

  // if(icon.className === 'uil uil-plus-circle'){
}

let noOfCharac = 150;
let contents = document.querySelectorAll(".content");
contents.forEach((content) => {
  // if text length is less that noOfCharac...then
  // hide the read more button

  if (content.textContent.length < noOfCharac) {
    content.nextElementSibling.style.display = "none";
  } else {
    let displayText = content.textContent.slice(0, noOfCharac);
    let moreText = content.textContent.slice(noOfCharac);
    content.innerHTML = `${displayText}<span class="dots">...</span>
        <span class="hide more">${moreText}</span>`;
  }
});

function readMore(btn) {
  let post = btn.parentElement;
  post.querySelector(".dots").classList.toggle("hide");
  post.querySelector(".more").classList.toggle("hide");
  btn.textContent == "Read More"
    ? (btn.textContent = "Read Less")
    : (btn.textContent = "Read More");
}

/* Login and Sign up JS */

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const login_container = document.querySelector(".login-container");

// sign_up_btn.addEventListener("click", () => {
//   login_container.classList.add("sign-up-mode");
// });

// sign_in_btn.addEventListener("click", () => {
//   login_container.classList.remove("sign-up-mode");
// });

/* End of Login and Sign up JS */
