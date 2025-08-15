 <div class="custom-select5" id="quarter">
    <div class="select-box5">{{ __('string.Mikrorajonas') }}</div>
    <div class="options-container5">
      <div class="option"><label><input type="checkbox" value=""></label></div>
    </div>
    <input type="hidden" name="quarter" id="quarter2" />
  </div>

 <style>

    .custom-select5 {
      position: relative;
      width: 300px;
      user-select: none;
    }

    .custom-select5 .select-box5 {
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

    .custom-select5 .select-box5::after {
      content: "▼";
      /* content: "\2228"; */
      margin-left: auto;
      pointer-events: none;
      transform: rotate(0deg);
      font-size: 13px;
    }

    .custom-select5 .tag {
      background: #e0e0e0;
      border-radius: 12px;
      padding: 2px 8px;
      display: inline-flex;
      align-items: center;
      font-size: 13px;
    }

    .custom-select5 .tag .remove {
      margin-left: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .custom-select5 .options-container5 {
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

    .custom-select5 .option {
      cursor: pointer;
      text-align: left;
    }

    .custom-select5 .option label{
      padding: 10px;
      cursor: pointer;
      display: block;
    }


    .custom-select5 .option:hover {
      background-color: #f0f0f0;
    }

    .custom-select5 .option input {
      margin-right: 8px;
    }

    .custom-select5 .select-box.active {
      border-color: #66afe9;
    }
  </style>


  <script>


  </script>
