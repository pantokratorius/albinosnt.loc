

<div class="custom-select" id="multiSelect">
  <div class="select-box">{{ __('search.Šildymas') }}</div>

  <div class="options-container">
    <!-- 🔍 Search input -->
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="{{ __('search.Ieškoti') }}...">
    </div>

    @foreach($heating as $key => $value)
    <div class="option">
      <label>
        <input type="checkbox" value="{{$key}}">
        {{__('components.'.$value)}}
      </label>
    </div>
    @endforeach
  </div>

  <input type="hidden" name="heating" id="heating_input" />
</div>

<style>
  .custom-select {
    position: relative;
    width: 300px;
    user-select: none;
  }

  .custom-select .select-box {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 6px 10px;
    cursor: pointer;
    background: #fff;
    min-height: 40px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 5px;
  }

  .custom-select .select-box::after {
    content: "▼";
    margin-left: auto;
    pointer-events: none;
    font-size: 13px;
  }

  .custom-select .tag {
    background: #e0e0e0;
    border-radius: 12px;
    padding: 2px 8px;
    display: inline-flex;
    align-items: center;
    font-size: 13px;
  }

  .custom-select .tag .remove {
    margin-left: 6px;
    cursor: pointer;
    font-weight: bold;
  }

  .custom-select .options-container {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ccc;
    border-top: none;
    max-height: 250px;
    overflow-y: auto;
    z-index: 10;
    display: none;
  }

  .custom-select .option {
    cursor: pointer;
    text-align: left;
  }

  .custom-select .option label {
    padding: 10px;
    cursor: pointer;
    display: block;
  }

  .custom-select .option:hover {
    background-color: #f0f0f0;
  }

  .custom-select .option input {
    margin-right: 8px;
  }

  .custom-select .select-box.active {
    border-color: #66afe9;
  }

  /* 🔍 search box styling */
  .custom-select .search-box {
    padding: 8px;
    border-bottom: 1px solid #ccc;
    background: white;
    position: sticky;
    top: 0;
    z-index: 1;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .custom-select .search-box input {
    width: 100%;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
</style>

<script>
  const select = document.getElementById("multiSelect");
  const selectBox = select.querySelector(".select-box");
  const optionsContainer = select.querySelector(".options-container");
  const checkboxes = select.querySelectorAll("input[type='checkbox']");
  const searchInput = document.getElementById("searchInput");
  const data_input = document.querySelector('#heating_input');

  function updateSelected() {
    selectBox.innerHTML = '';

    const selected = Array.from(checkboxes)
      .filter(c => c.checked)
      .map(c => ({
        value: c.value,
        label: c.parentElement.textContent.trim()
      }));

    if (selected.length === 0) {
      selectBox.textContent = "{{ __('search.Šildymas') }}";
      data_input.value = '';
      return;
    }

    selected.forEach(item => {
      const tag = document.createElement('span');
      tag.className = 'tag';
      tag.textContent = item.label;

      const remove = document.createElement('span');
      remove.className = 'remove';
      remove.textContent = '×';
      remove.addEventListener('click', (e) => {
        e.stopPropagation();
        const checkbox = Array.from(checkboxes).find(c => c.value === item.value);
        if (checkbox) {
          checkbox.checked = false;
          updateSelected();
        }
      });

      tag.appendChild(remove);
      selectBox.appendChild(tag);
    });

    data_input.value = selected.map(item => item.label).join(';');

     searchInput.select();
  }

  // Toggle dropdown
  selectBox.addEventListener("click", () => {
    const isOpen = optionsContainer.style.display === "block";
    optionsContainer.style.display = isOpen ? "none" : "block";
    selectBox.classList.toggle("active");
    if (!isOpen) searchInput.focus(); // focus search when opening
  });

  checkboxes.forEach(cb => {
    cb.addEventListener("change", updateSelected);
  });

  document.addEventListener("click", (e) => {
    if (!select.contains(e.target)) {
      optionsContainer.style.display = "none";
      selectBox.classList.remove("active");
    }
  });

  // 🔍 Search filter
  searchInput.addEventListener("input", function () {
    const filter = this.value.toLowerCase();
    const options = select.querySelectorAll(".option");
    options.forEach(opt => {
      const text = opt.textContent.toLowerCase();
      opt.style.display = text.includes(filter) ? "block" : "none";
    });
  });

  updateSelected();
</script>
