 <div class="custom-select4" id="multiSelect4">
    <div class="select-box4">{{ __('string.Paskirtis') }}</div>
    <div class="options-container4">
      @foreach($purpose2 as $key => $value)
      <div class="option"><label><input type="checkbox" value="{{$key}}">{{__('string.'.$value)}}</label></div>
      @endforeach
    </div>
    <input type="hidden" name="purpose2" id="purpose2" />
  </div>

 <style>

    .custom-select4 {
      position: relative;
      width: 300px;
      user-select: none;
    }

    .custom-select4 .select-box4 {
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

    .custom-select4 .select-box4::after {
      content: "▼";
      /* content: "\2228"; */
      margin-left: auto;
      pointer-events: none;
      transform: rotate(0deg);
      font-size: 13px;
    }

    .custom-select4 .tag {
      background: #e0e0e0;
      border-radius: 12px;
      padding: 2px 8px;
      display: inline-flex;
      align-items: center;
      font-size: 13px;
    }

    .custom-select4 .tag .remove {
      margin-left: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .custom-select4 .options-container4 {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      border-top: none;
      max-height: 200px;
      overflow-y: auto;
      z-index: 10;
      display: none;
    }

    .custom-select4 .option {
      cursor: pointer;
      text-align: left;
    }

    .custom-select4 .option label{
      padding: 10px;
      cursor: pointer;
      display: block;
    }


    .custom-select4 .option:hover {
      background-color: #f0f0f0;
    }

    .custom-select4 .option input {
      margin-right: 8px;
    }

    .custom-select4 .select-box.active {
      border-color: #66afe9;
    }
  </style>


  <script>
    const select4 = document.getElementById("multiSelect4");
    const selectBox4 = select4.querySelector(".select-box4");
    const optionsContainer4 = select4.querySelector(".options-container4");
    const checkboxes4 = select4.querySelectorAll("input[type='checkbox']");

    const purpose2 = document.querySelector('#purpose2');

    function updateSelected() {

      selectBox4.innerHTML = '';

      const selected = Array.from(checkboxes4)
        .filter(c => c.checked)
        .map(c => ({
          value: c.value,
          label: c.parentElement.textContent.trim()
        }));

      if (selected.length === 0) {
        selectBox4.textContent = "{{ __('string.Paskirtis') }}";
        purpose2.value = ''
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
          const checkbox = Array.from(checkboxes4).find(c => c.value === item.value);
          if (checkbox) {
            checkbox.checked = false;
            updateSelected();
          }
        });

        tag.appendChild(remove);
        selectBox4.appendChild(tag);
      });

      // const arrow = document.createElement('span');
      // arrow.style.marginLeft = 'auto';
      // arrow.textContent = "▼";
      // selectBox.appendChild(arrow);
      purpose2.value = selected.map(item => [item.label].join(';'))
    }

    selectBox4.addEventListener("click", () => {
      const isOpen = optionsContainer4.style.display === "block";
      optionsContainer4.style.display = isOpen ? "none" : "block";
      selectBox4.classList.toggle("active");
    });

    checkboxes4.forEach(cb => {
      cb.addEventListener("change", updateSelected);
    });

    document.addEventListener("click", (e) => {
      if (!select4.contains(e.target)) {
        optionsContainer4.style.display = "none";
        selectBox4.classList.remove("active");
      }
    });

    updateSelected();
  </script>
