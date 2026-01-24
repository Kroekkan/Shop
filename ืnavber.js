new Swiper('.swiper', {
  autoplay: { delay: 2000 },
  loop: true
}); 

const links = document.querySelectorAll('.nav-link');

  links.forEach(link => {
    link.addEventListener('click', () => {
      // เอาสี active ออกจากทุกอัน
      links.forEach(l => {
        l.classList.remove('text-pink-300', 'font-bold');
        l.classList.add('text-white');
      });

      // ใส่สี active ให้ตัวที่คลิก
      link.classList.remove('text-white');
      link.classList.add('text-pink-300', 'font-bold');
    });
  });