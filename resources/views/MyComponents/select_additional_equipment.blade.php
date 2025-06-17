 <div class="custom-select2" id="multiSelect2">
    <div class="select-box2">Įrengimas</div>
    <div class="options-container2">
      @foreach($additional_equipment as $key => $value)
      <div class="option"><label><input type="checkbox" value="{{$key}}"> {{$value}}</label></div>
      @endforeach
    </div>
  </div>

 <style>
 
    .custom-select2 {
      position: relative;
      width: 300px;
      user-select: none;
    }

    .custom-select2 .select-box2 {
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

    .custom-select2 .select-box2::after {
      content: "▼";
      /* content: "\2228"; */
      margin-left: auto;
      pointer-events: none;
      transform: rotate(0deg);
      font-size: 13px;
    }

    .custom-select2 .tag {
      background: #e0e0e0;
      border-radius: 12px;
      padding: 2px 8px;
      display: inline-flex;
      align-items: center;
      font-size: 13px;
    }

    .custom-select2 .tag .remove {
      margin-left: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .custom-select2 .options-container2 {
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

    .custom-select2 .option {
      cursor: pointer;
      text-align: left;
    }
    
    .custom-select2 .option label{
      padding: 10px;
      cursor: pointer;
      display: block;
    }
    

    .custom-select2 .option:hover {
      background-color: #f0f0f0;
    }

    .custom-select2 .option input {
      margin-right: 8px;
    }

    .custom-select2 .select-box.active {
      border-color: #66afe9;
    }
  </style>


  <script>
    const select2 = document.getElementById("multiSelect2");
    const selectBox2 = select2.querySelector(".select-box2");
    const optionsContainer2 = select2.querySelector(".options-container2");
    const checkboxes2 = select2.querySelectorAll("input[type='checkbox']");

    function updateSelected() {
      // Очистить старые теги
      selectBox2.innerHTML = '';

      const selected = Array.from(checkboxes2)
        .filter(c => c.checked)
        .map(c => ({
          value: c.value,
          label: c.parentElement.textContent.trim()
        }));

      if (selected.length === 0) {
        selectBox2.textContent = "Įrengimas";
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
          const checkbox = Array.from(checkboxes2).find(c => c.value === item.value);
          if (checkbox) {
            checkbox.checked = false;
            updateSelected();
          }
        });

        tag.appendChild(remove);
        selectBox2.appendChild(tag);
      });

      // Добавить стрелку
      // const arrow = document.createElement('span');
      // arrow.style.marginLeft = 'auto';
      // arrow.textContent = "▼";
      // selectBox.appendChild(arrow);
    }

    // Показать / скрыть список
    selectBox2.addEventListener("click", () => { 
      const isOpen = optionsContainer2.style.display === "block";
      optionsContainer2.style.display = isOpen ? "none" : "block";
      selectBox2.classList.toggle("active");
    });

    // Обновить выбранные при клике на чекбоксы
    checkboxes2.forEach(cb => {
      cb.addEventListener("change", updateSelected);
    });

    // Закрытие при клике вне
    document.addEventListener("click", (e) => {
      if (!select2.contains(e.target)) {
        optionsContainer2.style.display = "none";
        selectBox2.classList.remove("active");
      }
    });

    // Инициализация
    updateSelected();
  </script>