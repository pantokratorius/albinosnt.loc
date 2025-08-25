<style>
/* GDPR Banner */
#gdpr-banner {
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  display: none;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin: 12px auto;
  max-width: 900px;
  padding: 16px;
  box-shadow: 1px 2px 8px #787878;
  font-family: sans-serif;
}

#gdpr-banner .banner-content {
  display: flex;
  flex-direction: column;
  gap: 12px;
  align-items: flex-start;
}

#gdpr-banner .banner-content h3 {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 6px;
}

#gdpr-banner .banner-content p {
  font-size: 14px;
  color: #333;
}

#gdpr-banner .banner-buttons {
  margin-top: 12px;
}

#gdpr-banner .banner-buttons button {
  padding: 6px 12px;
  margin-right: 6px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  cursor: pointer;
}

#gdpr-banner .banner-buttons button.accept-all {
  background-color: #000;
  color: #fff;
  border: none;
}

/* GDPR Modal */
#gdpr-modal {
  position: fixed;
  inset: 0;
  z-index: 10000;
  display: none;
  font-family: sans-serif;
  overflow: auto;
}

#gdpr-modal .overlay {
  position: absolute;
  inset: 0;
  background-color: rgba(0,0,0,0.4);
}

#gdpr-modal .modal-box {
  position: relative;
  margin: 60px auto 0 auto;
  max-width: 700px;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

#gdpr-modal .modal-header {
  padding: 16px;
  border-bottom: 1px solid #ccc;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

#gdpr-modal .modal-header h3 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

#gdpr-modal .modal-header button {
  font-size: 20px;
  background: none;
  border: none;
  cursor: pointer;
}

#gdpr-modal form {
  padding: 16px;
}

.gdpr-option {
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 12px;
  margin-bottom: 12px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.gdpr-option div.labels {
  max-width: 80%;
}

.gdpr-option div.labels .title {
  font-weight: 500;
  margin-bottom: 4px;
}

.gdpr-option div.labels .desc {
  font-size: 13px;
  color: #555;
}

.gdpr-option input[type="checkbox"] {
  margin-left: 8px;
  transform: scale(1.2);
}

#gdpr-save{
    padding: 15px;
    margin: 15px 0 25px;
}

.gdpr-save-container {
  display: flex;
  justify-content: flex-end;
  border-top: 1px solid #ccc;
  padding-top: 12px;
}

.gdpr-save-container button {
  padding: 6px 12px;
  background-color: #000;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

@media(max-width: 500px){

  #gdpr-banner .banner-buttons > button {
    margin-bottom: 10px;
  }

  #gdpr-banner .banner-buttons  {
    text-align: center
  }

}

</style>

<!-- GDPR Banner -->
<div id="gdpr-banner">
  <div class="banner-content">
    <div>
      <h3>{{ __('gdpr.title') }}</h3>
      <p>
        {{ __('gdpr.intro') }}
        <a href="{{ route(app()->getlocale() . '_privacy') }}">{{ __('gdpr.policy') }}</a>
      </p>
    </div>
    <div class="banner-buttons">
      <button id="gdpr-reject-all">{{ __('gdpr.reject_all') }}</button>
      <button id="gdpr-settings">{{ __('gdpr.customize') }}</button>
      <button id="gdpr-accept-all" class="accept-all">{{ __('gdpr.accept_all') }}</button>
    </div>
  </div>
</div>

<!-- GDPR Modal -->
<div id="gdpr-modal">
  <div class="overlay"></div>
  <div class="modal-box">
    <div class="modal-header">
      <h3>{{ __('gdpr.title') }}</h3>
      <button id="gdpr-close">×</button>
    </div>
    <form id="gdpr-form">
      <!-- Necessary -->
      <div class="gdpr-option">
        <div class="labels">
          <div class="title">{{ __('gdpr.necessary') }}</div>
          <div class="desc">{{ __('gdpr.necessary_desc') }}</div>
        </div>
        <input type="checkbox" checked disabled>
      </div>

      <!-- Preferences -->
      <x-gdpr-toggle name="preferences" label="{{ __('gdpr.preferences') }}" desc="{{ __('gdpr.preferences_desc') }}" />

      <!-- Analytics -->
      <x-gdpr-toggle name="analytics" label="{{ __('gdpr.analytics') }}" desc="{{ __('gdpr.analytics_desc') }}" />

      <!-- Marketing -->
      <x-gdpr-toggle name="marketing" label="{{ __('gdpr.marketing') }}" desc="{{ __('gdpr.marketing_desc') }}" />

      <!-- Media -->
      <x-gdpr-toggle name="media" label="{{ __('gdpr.media') }}" desc="{{ __('gdpr.media_desc') }}" />

      <div class="gdpr-save-container">
        <button type="button" id="gdpr-save">{{ __('gdpr.save') }}</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('gdpr-banner');
    const modal = document.getElementById('gdpr-modal');
    const closeBtn = document.getElementById('gdpr-close');
    const settingsBtn = document.getElementById('gdpr-settings');
    const acceptAllBtn = document.getElementById('gdpr-accept-all');
    const rejectAllBtn = document.getElementById('gdpr-reject-all');
    const saveBtn = document.getElementById('gdpr-save');
    const toggles = document.querySelectorAll('.gdpr-toggle');

    // Show banner if no consent
    if (!localStorage.getItem('gdprConsent')) {
        banner.style.display = 'block';
    }

    // Open modal
    settingsBtn.addEventListener('click', () => modal.style.display = 'block');

    // Close modal
    closeBtn.addEventListener('click', () => modal.style.display = 'none');

    // Accept all
    acceptAllBtn.addEventListener('click', () => {
        const consent = { necessary: true, preferences: true, analytics: true, marketing: true, media: true };
        saveConsent(consent);
    });

    // Reject non-essential
    rejectAllBtn.addEventListener('click', () => {
        const consent = { necessary: true, preferences: false, analytics: false, marketing: false, media: false };
        saveConsent(consent);
    });

    // Save modal settings
    saveBtn.addEventListener('click', () => {
        const consent = {
            necessary: true,
            preferences: document.querySelector('input[name="preferences"]').checked,
            analytics: document.querySelector('input[name="analytics"]').checked,
            marketing: document.querySelector('input[name="marketing"]').checked,
            media: document.querySelector('input[name="media"]').checked,
        };
        saveConsent(consent);
    });

    function saveConsent(consent) {
        localStorage.setItem('gdprConsent', JSON.stringify(consent));
        banner.style.display = 'none';
        modal.style.display = 'none';
        enableScripts(consent);
    }

    // Enable scripts according to consent
    function enableScripts(consent) {
        document.querySelectorAll('script[type="text/plain"][data-category]').forEach(script => {
            const category = script.getAttribute('data-category');
            if (consent[category]) {
                const newScript = document.createElement('script');
                if(script.src) newScript.src = script.src;
                newScript.innerHTML = script.innerHTML;
                document.head.appendChild(newScript);
            }
        });
        const options = [...document.querySelectorAll('.gdpr-option input[type="checkbox"]') ]
        options.forEach(item => {
          if(consent[item.name])
            if(consent[item.name] == true)
              item.checked = true
        })

    }

    // Load saved consent
    const savedConsent = localStorage.getItem('gdprConsent');
    if (savedConsent) enableScripts(JSON.parse(savedConsent));
});
</script>
