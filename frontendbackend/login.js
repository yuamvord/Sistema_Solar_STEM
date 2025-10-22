document.addEventListener('DOMContentLoaded', () => {
  const switchButtons = document.querySelectorAll('.switch-form-btn');

  switchButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const targetClass = btn.getAttribute('data-target');
      const targetForm = document.querySelector(`.${targetClass}`);

      if (targetForm) {
        targetForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
        targetForm.style.boxShadow = '0 0 15px rgba(2,107,165,0.5)';
        setTimeout(() => targetForm.style.boxShadow = '', 800);
      }
    });
  });
});
