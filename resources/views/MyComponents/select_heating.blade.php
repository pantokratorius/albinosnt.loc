 <div class="custom-select" id="multiSelect">
    <div class="select-box">Šildymas</div>
    <div class="options-container">
      @foreach($heating as $key => $value)
      <div class="option"><label><input type="checkbox" value="{{$key}}"> {{$value}}</label></div>
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
      /* content: "\2228"; */
      margin-left: auto;
      pointer-events: none;
      transform: rotate(0deg);
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
      max-height: 200px;
      overflow-y: auto;
      z-index: 10;
      display: none;
    }

    .custom-select .option {
      cursor: pointer;
      text-align: left;
    }
    
    .custom-select .option label{
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
  </style>


  <script>
    const select = document.getElementById("multiSelect");
    const selectBox = select.querySelector(".select-box");
    const optionsContainer = select.querySelector(".options-container");
    const checkboxes = select.querySelectorAll("input[type='checkbox']");

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
        selectBox.textContent = "Šildymas";
        data_input.value = ''
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

      // const arrow = document.createElement('span');
      // arrow.style.marginLeft = 'auto';
      // arrow.textContent = "▼";
      // selectBox.appendChild(arrow);
      
      data_input.value = selected.map(item => [item.label].join(';'))
    }

    // Показать / скрыть список
    selectBox.addEventListener("click", () => { 
      const isOpen = optionsContainer.style.display === "block";
      optionsContainer.style.display = isOpen ? "none" : "block";
      selectBox.classList.toggle("active");
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

    updateSelected();
  </script>