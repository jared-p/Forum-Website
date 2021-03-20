const navSlide = () => {
  const sandwich = document.querySelector('.sandwich');
  const nav = document.querySelector('.nav_links');
  const navLinks = document.querySelectorAll('.nav_links li');

  //toggle
  sandwich.addEventListener('click', () => {
    nav.classList.toggle('nav-active');
    //Animate navLinks
    navLinks.forEach((link, index) => {
      // console.log(index);
      if (link.style.Animation) {
        link.style.Animation = '';
      } else {
        link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
      
        //console.log(index/7);
      }
    });
//sandwich animation
sandwich.classList.toggle('toggle');
  });

}
navSlide();
