 <div class="custom-select3" id="multiSelect3">
    <div class="select-box3">{{ __('string.Paskirtis') }}</div>
    <div class="options-container3">
      @foreach($purpose as $key => $value)
      <div class="option"><label><input type="checkbox" value="{{$key}}">{{__('string.'.$value)}}</label></div>
      @endforeach
    </div>
    <input type="hidden" name="purpose" id="purpose" />
  </div>

 <style>

    .custom-select3 {
      position: relative;
      width: 300px;
      user-select: none;
    }

    .custom-select3 .select-box3 {
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

    .custom-select3 .select-box3::after {
      content: "▼";
      /* content: "\2228"; */
      margin-left: auto;
      pointer-events: none;
      transform: rotate(0deg);
      font-size: 13px;
    }

    .custom-select3 .tag {
      background: #e0e0e0;
      border-radius: 12px;
      padding: 2px 8px;
      display: inline-flex;
      align-items: center;
      font-size: 13px;
    }

    .custom-select3 .tag .remove {
      margin-left: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .custom-select3 .options-container3 {
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

    .custom-select3 .option {
      cursor: pointer;
      text-align: left;
    }

    .custom-select3 .option label{
      padding: 10px;
      cursor: pointer;
      display: block;
    }


    .custom-select3 .option:hover {
      background-color: #f0f0f0;
    }

    .custom-select3 .option input {
      margin-right: 8px;
    }

    .custom-select3 .select-box.active {
      border-color: #66afe9;
    }
  </style>


  <script>
    const select3 = document.getElementById("multiSelect3");
    const selectBox3 = select3.querySelector(".select-box3");
    const optionsContainer3 = select3.querySelector(".options-container3");
    const checkboxes3 = select3.querySelectorAll("input[type='checkbox']");

    const purpose = document.querySelector('#purpose');

    function updateSelected() {

      selectBox3.innerHTML = '';

      const selected = Array.from(checkboxes3)
        .filter(c => c.checked)
        .map(c => ({
          value: c.value,
          label: c.parentElement.textContent.trim()
        }));

      if (selected.length === 0) {
        selectBox3.textContent = "{{ __('string.Paskirtis') }}";
        purpose.value = ''
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
          const checkbox = Array.from(checkboxes3).find(c => c.value === item.value);
          if (checkbox) {
            checkbox.checked = false;
            updateSelected();
          }
        });

        tag.appendChild(remove);
        selectBox3.appendChild(tag);
      });

      // const arrow = document.createElement('span');
      // arrow.style.marginLeft = 'auto';
      // arrow.textContent = "▼";
      // selectBox.appendChild(arrow);
      purpose.value = selected.map(item => [item.label].join(';'))
    }

    selectBox3.addEventListener("click", () => {
      const isOpen = optionsContainer3.style.display === "block";
      optionsContainer3.style.display = isOpen ? "none" : "block";
      selectBox3.classList.toggle("active");
    });

    checkboxes3.forEach(cb => {
      cb.addEventListener("change", updateSelected);
    });

    document.addEventListener("click", (e) => {
      if (!select3.contains(e.target)) {
        optionsContainer3.style.display = "none";
        selectBox3.classList.remove("active");
      }
    });

    updateSelected();
  </script>
