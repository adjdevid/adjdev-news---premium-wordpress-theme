/**
 * ADJDEV News Admin Scripts
 */
document.addEventListener('DOMContentLoaded', function () {
  // Color Picker Initialization
  if (typeof jQuery !== 'undefined' && jQuery.fn.wpColorPicker) {
    jQuery('.adjdev-color-input').wpColorPicker();
  }

  // Tab Navigation
  const tabs = document.querySelectorAll('.adjdev-nav-tabs li');
  const panes = document.querySelectorAll('.tab-pane');

  tabs.forEach(tab => {
    tab.addEventListener('click', function () {
      const targetId = this.getAttribute('data-tab');
      tabs.forEach(t => t.classList.remove('active'));
      panes.forEach(p => p.classList.remove('active'));

      this.classList.add('active');
      const targetPane = document.getElementById(targetId);
      if (targetPane) {
        targetPane.classList.add('active');
      }
    });
  });

  // Search Settings
  const searchInput = document.getElementById('adjdev-search-settings');
  if (searchInput) {
    searchInput.addEventListener('input', function () {
      const query = this.value.toLowerCase().trim();
      const fields = document.querySelectorAll('.opt-field');

      if (!query) {
        fields.forEach(f => f.style.display = '');
        return;
      }

      fields.forEach(field => {
        const text = field.textContent.toLowerCase();
        field.style.display = text.includes(query) ? '' : 'none';
      });
    });
  }

  // Save Options via AJAX
  const saveBtn = document.getElementById('adjdev-save-options-btn');
  const form = document.getElementById('adjdev-options-form');

  if (saveBtn && form) {
    saveBtn.addEventListener('click', function (e) {
      e.preventDefault();

      const btnText = saveBtn.querySelector('.btn-text');
      const spinner = saveBtn.querySelector('.spinner');

      btnText.textContent = adjdevAdminData.i18n.saving;
      spinner.classList.add('is-active');
      saveBtn.disabled = true;

      const formData = new FormData(form);
      formData.append('action', 'adjdev_news_save_options');
      formData.append('security', adjdevAdminData.nonce);

      fetch(adjdevAdminData.ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        spinner.classList.remove('is-active');
        saveBtn.disabled = false;
        if (data.success) {
          btnText.textContent = adjdevAdminData.i18n.saved;
          setTimeout(() => {
            btnText.textContent = 'Save Changes';
          }, 2000);
        } else {
          btnText.textContent = 'Error Saving';
          alert(data.data ? data.data.message : 'Error saving settings');
        }
      })
      .catch(err => {
        spinner.classList.remove('is-active');
        saveBtn.disabled = false;
        btnText.textContent = 'Save Changes';
        console.error(err);
      });
    });
  }

  // Template Library Activation
  const activateButtons = document.querySelectorAll('.adjdev-activate-tpl-btn');
  activateButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const templateId = this.getAttribute('data-id');
      const templateName = this.getAttribute('data-name');

      if (!confirm(adjdevAdminData.i18n.confirmActivate + ' (' + templateName + ')')) {
        return;
      }

      const btnText = this.querySelector('.btn-text');
      const spinner = this.querySelector('.spinner');

      btnText.textContent = adjdevAdminData.i18n.activating;
      spinner.classList.add('is-active');
      this.disabled = true;

      const payload = new FormData();
      payload.append('action', 'adjdev_news_activate_template');
      payload.append('template_id', templateId);
      payload.append('security', adjdevAdminData.nonce);

      fetch(adjdevAdminData.ajaxUrl, {
        method: 'POST',
        body: payload
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          spinner.classList.remove('is-active');
          this.disabled = false;
          btnText.textContent = 'Activate';
          alert(data.data ? data.data.message : 'Failed to activate template');
        }
      })
      .catch(err => {
        spinner.classList.remove('is-active');
        this.disabled = false;
        btnText.textContent = 'Activate';
        console.error(err);
      });
    });
  });
});
