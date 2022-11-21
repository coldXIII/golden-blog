const navItems = document.querySelector('.nav__items');
const openNavBtn = document.querySelector('#open-nav__btn');
const closeNavBtn = document.querySelector('#close-nav__btn');

const openNav = () => {
  navItems.style.display = 'flex';
  openNavBtn.style.display = 'none';
  closeNavBtn.style.display = 'block';
};
const closeNav = () => {
  navItems.style.display = 'none';
  closeNavBtn.style.display = 'none';
  openNavBtn.style.display = 'block';
};

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);
