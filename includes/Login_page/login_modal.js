document.addEventListener('DOMContentLoaded', () => {
  // 1. Open modal when any element with data-open-modal="loginModal" is clicked
  document.querySelectorAll('[data-open-modal]').forEach(trigger => {
    trigger.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default link behavior
      const targetId = trigger.getAttribute('data-open-modal');
      const modal = document.getElementById(targetId);
      if (modal) modal.showModal();
    });
  });

  // 2. Attach close behaviors to all modals
  document.querySelectorAll('dialog.modal').forEach(modal => {
    const closeBtn = modal.querySelector('[data-close-modal]');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => modal.close());
    }

    // Close if user clicks on the dark backdrop outside the modal box
    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.close();
      }
    });
  });

  // 3. Auto-open modal if PHP set data-auto-open="true" (e.g., failed login)
  const autoOpenModal = document.querySelector('dialog[data-auto-open="true"]');
  if (autoOpenModal) {
    autoOpenModal.showModal();
  }
});