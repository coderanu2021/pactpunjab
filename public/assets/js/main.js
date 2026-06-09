
  function toggleGroup(group) {
    const isOpen = group.classList.contains('open');
    // close all
    document.querySelectorAll('.nav-group.open').forEach(g => g.classList.remove('open'));
    if (!isOpen) group.classList.add('open');
  }

  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }

  // Close sidebar on outside click (mobile)
  document.addEventListener('click', function(e) {
    const sb = document.getElementById('sidebar');
    if (window.innerWidth <= 768 && sb.classList.contains('open')) {
      if (!sb.contains(e.target) && !e.target.closest('.hamburger')) {
        sb.classList.remove('open');
      }
    }
  });

  // Approve/reject button feedback
  document.querySelectorAll('.icon-btn.approve').forEach(btn => {
    btn.addEventListener('click', function() {
      const item = this.closest('.pending-item');
      item.style.opacity = '0';
      item.style.transition = 'opacity .3s';
      setTimeout(() => item.remove(), 300);
    });
  });
  document.querySelectorAll('.icon-btn.reject').forEach(btn => {
    btn.addEventListener('click', function() {
      const item = this.closest('.pending-item');
      item.style.opacity = '0';
      item.style.transition = 'opacity .3s';
      setTimeout(() => item.remove(), 300);
    });
  });
