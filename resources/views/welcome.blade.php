<script defer src="https://cdn.jsdelivr.net/npm/@colinaut/alpinejs-plugin-simple-validate@latest/dist/alpine.validate.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>

<a href="dashboard">admin</a>



<div style="width: 80%; margin: 0 auto">
<form id="form" x-data x-validate @submit="$validate.submit" method="post">
    <div>
      <label for="name">Vardas</label>
      <input type="text" id="name" name="name" required data-error-msg="Užpildykite laukelį" />
    </div>
    <div>
      <label for="email">Telefono Nr</label>
      <input type="email" id="email" name="email" required data-error-msg="Užpildykite laukelį" />
    </div>
    {{-- <div>
      <label for="wholenumber">Целое число *</label>
      <input type="wholenumber" id="wholenumber" name="wholenumber" required x-validate.wholenumber data-error-msg="Укажите положительное целое число" />
    </div> --}}
    {{-- <div id="animals">
      <h4>Любимые животные *</h4>
      <div class="flex items-baseline gap-4" data-error-msg="Вы должны выбрать хотя бы одно животное">
        <label><input type="checkbox" x-validate.group name="animals" id="cat" value="cat">Кошка</label>
        <label><input type="checkbox" x-validate.group name="animals" id="dog" value="dog">Собака</label>
        <label><input type="checkbox" x-validate.group name="animals" id="bunny" value="bunny">Кролик</label>
      </div>
    </div> --}}
    <div>
      <input type="submit" value="Siųsti">
    </div>
  </form>
</div>
  <style>
    .error-msg {
      color: red;
    }
  </style>