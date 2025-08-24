@php $index = 2; @endphp
<div class="custom-select{{ $index }}" id="multiSelect{{ $index }}">
    <div class="select-box{{ $index }}">{{ __('search.Įrengimas') }}</div>
    <div class="options-container{{ $index }}">
        <div class="search-box{{ $index }}">
            <input type="text" id="searchInput{{ $index }}" placeholder="{{ __('search.Ieškoti') }}...">
        </div>
      @foreach($additional_equipment as $key => $value)
      <div class="option"><label><input type="checkbox" value="{{$key}}">{{__('components.'.$value)}}</label></div>
      @endforeach
    </div>
    <input type="hidden" name="additional_equipment" id="additional_equipment" />
  </div>

 <style>

    .custom-select{{ $index }} {
      position: relative;
      width: 300px;
      user-select: none;
    }

    .custom-select{{ $index }} .select-box{{ $index }} {
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

    .custom-select{{ $index }} .select-box{{ $index }}::after {
      content: "▼";
      /* content: "\2228"; */
      margin-left: auto;
      pointer-events: none;
      transform: rotate(0deg);
      font-size: 13px;
    }

    .custom-select{{ $index }} .tag {
      background: #e0e0e0;
      border-radius: 12px;
      padding: 2px 8px;
      display: inline-flex;
      align-items: center;
      font-size: 13px;
    }

    .custom-select{{ $index }} .tag .remove {
      margin-left: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .custom-select{{ $index }} .options-container{{ $index }} {
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

    .custom-select{{ $index }} .option {
      cursor: pointer;
      text-align: left;
    }

    .custom-select{{ $index }} .option label{
      padding: 10px;
      cursor: pointer;
      display: block;
    }


    .custom-select{{ $index }} .option:hover {
      background-color: #f0f0f0;
    }

    .custom-select{{ $index }} .option input {
      margin-right: 8px;
    }

    .custom-select{{ $index }} .select-box{{ $index }}.active {
      border-color: #66afe9;
    }

    .custom-select{{ $index }} .search-box{{ $index }} {
        padding: 8px;
        border-bottom: 1px solid #ccc;
          background: white;
        position: sticky;
        top: 0;
        z-index: 1;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05)
    }

    .custom-select{{ $index }} .search-box{{ $index }} input {
        width: 100%;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

  </style>


  <script>
    const select{{ $index }} = document.getElementById("multiSelect{{ $index }}");
    const selectBox{{ $index }} = select{{ $index }}.querySelector(".select-box{{ $index }}");
    const optionsContainer{{ $index }} = select{{ $index }}.querySelector(".options-container{{ $index }}");
     const searchInput{{ $index }} = document.getElementById("searchInput{{ $index }}");
    const checkboxes{{ $index }} = select{{ $index }}.querySelectorAll("input[type='checkbox']");

    const additional_equipment = document.querySelector('#additional_equipment');

    function updateSelected{{ $index }}() {

      selectBox{{ $index }}.innerHTML = '';

      const selected = Array.from(checkboxes{{ $index }})
        .filter(c => c.checked)
        .map(c => ({
          value: c.value,
          label: c.parentElement.textContent.trim()
        }));

      if (selected.length === 0) {
        selectBox{{ $index }}.textContent = "{{ __('search.Įrengimas') }}";
        additional_equipment.value = ''
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
          const checkbox = Array.from(checkboxes{{ $index }}).find(c => c.value === item.value);
          if (checkbox) {
            checkbox.checked = false;
            updateSelected{{ $index }}();
          }
        });

        tag.appendChild(remove);
        selectBox{{ $index }}.appendChild(tag);
      });

      // const arrow = document.createElement('span');
      // arrow.style.marginLeft = 'auto';
      // arrow.textContent = "▼";
      // selectBox.appendChild(arrow);
      additional_equipment.value = selected.map(item => [item.label].join(';'))


    }

    selectBox{{ $index }}.addEventListener("click", () => {
      const isOpen = optionsContainer{{ $index }}.style.display === "block";
      optionsContainer{{ $index }}.style.display = isOpen ? "none" : "block";
      selectBox{{ $index }}.classList.toggle("active");
      if (!isOpen) searchInput{{ $index }}.focus();
    });

    checkboxes{{ $index }}.forEach(cb => {
      cb.addEventListener("change", updateSelected{{ $index }});
    });

    document.addEventListener("click", (e) => {
      if (!select{{ $index }}.contains(e.target)) {
        optionsContainer{{ $index }}.style.display = "none";
        selectBox{{ $index }}.classList.remove("active");
      }
    });

     searchInput{{ $index }}.addEventListener("input", function () {
        const filter{{ $index }} = this.value.toLowerCase();
        const options{{ $index }} = select{{ $index }}.querySelectorAll(".option");
        options{{ $index }}.forEach(opt => {
        const text{{ $index }} = opt.textContent.toLowerCase();
        opt.style.display = text{{ $index }}.includes(filter{{ $index }}) ? "block" : "none";
        });
    });

    updateSelected{{ $index }}();
  </script>
