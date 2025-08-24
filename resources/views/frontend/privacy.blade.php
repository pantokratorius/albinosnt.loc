@extends('layouts.frontend')

@section('title', 'Pagrindinis | Alginos NT')

@section('main')

<div class="max-w-4xl mx-auto p-6 prose">

<h1>Privatumo politika</h1>

<p>Paskutinį kartą atnaujinta: {{ now()->format('Y-m-d') }}</p>

<h2>1. Įvadas</h2>
<p>Šioje svetainėje <strong>alginosnt.lt</strong> mes gerbiame jūsų privatumą ir įsipareigojame apsaugoti jūsų asmens duomenis pagal Bendrąjį duomenų apsaugos reglamentą (GDPR).</p>

<h2>2. Duomenų rinkimas</h2>
<p>Mes renkame tik tuos duomenis, kurie yra būtini svetainės veikimui ir paslaugų teikimui. Tai gali būti:</p>
<ul>
  <li>Kontaktinė informacija (jei siunčiate užklausą per formą)</li>
  <li>Techninė informacija (IP adresas, naršyklės tipas, įrenginio duomenys)</li>
</ul>

<h2>3. Slapukai</h2>
<p>Mūsų svetainė naudoja slapukus, kurie suskirstyti į kategorijas:</p>

<ul>
  <li><strong>Būtini:</strong> reikalingi svetainės funkcionalumui (pvz., formos, saugumas).</li>
  <li><strong>Parinktys:</strong> įsimena jūsų pasirinkimus, pvz., kalbos nustatymus.</li>
  <li><strong>Analitika:</strong> padeda suprasti, kaip lankytojai naudoja svetainę (pvz., „Google Analytics“).</li>
  <li><strong>Rinkodara:</strong> naudojami reklamai, „Facebook Pixel“ ar kitoms reklamos priemonėms.</li>
  <li><strong>Medijos įskiepiai:</strong> leidžia rodyti trečiųjų šalių turinį, pvz., „YouTube“ vaizdo įrašus.</li>
</ul>

<p>Slapukus galite valdyti per <a href="javascript:void(0)" onclick="openCookieSettings()">Slapukų nustatymus</a>.</p>

<h2>4. Duomenų saugojimas</h2>
<p>Duomenys saugomi tiek, kiek reikia paslaugų teikimui ar kaip numato teisės aktai.</p>

<h2>5. Duomenų dalijimasis</h2>
<p>Duomenys gali būti perduoti trečiosioms šalims (pvz., analitikos ar reklamos tiekėjams), bet tik pagal GDPR reikalavimus.</p>

<h2>6. Jūsų teisės</h2>
<p>Pagal GDPR turite teisę:</p>
<ul>
  <li>Gauti prieigą prie savo duomenų</li>
  <li>Prašyti ištaisyti ar ištrinti duomenis</li>
  <li>Atsisakyti duomenų tvarkymo tam tikrais atvejais</li>
</ul>

<h2>7. Kontaktai</h2>
<p>Klausimams dėl privatumo rašykite: <a href="mailto:info@alginosnt.lt">info@alginosnt.lt</a></p>

<hr>

<h1>Политика конфиденциальности</h1>

<p>Последнее обновление: {{ now()->format('Y-m-d') }}</p>

<h2>1. Введение</h2>
<p>На сайте <strong>alginosnt.lt</strong> мы уважаем вашу конфиденциальность и защищаем персональные данные в соответствии с Общим регламентом по защите данных (GDPR).</p>

<h2>2. Сбор данных</h2>
<p>Мы собираем только те данные, которые необходимы для работы сайта и предоставления услуг, включая:</p>
<ul>
  <li>Контактные данные (если вы отправляете запрос через форму)</li>
  <li>Технические данные (IP-адрес, тип браузера, данные устройства)</li>
</ul>

<h2>3. Файлы cookie</h2>
<p>Наш сайт использует файлы cookie, разделенные на категории:</p>

<ul>
  <li><strong>Необходимые:</strong> нужны для функционирования сайта (например, формы, безопасность).</li>
  <li><strong>Предпочтения:</strong> сохраняют ваши выборы, например язык.</li>
  <li><strong>Аналитика:</strong> помогает понять, как посетители используют сайт (например, Google Analytics).</li>
  <li><strong>Маркетинг:</strong> используются для рекламы, Facebook Pixel и других инструментов.</li>
  <li><strong>Медиа-встраивания:</strong> позволяют показывать сторонний контент, например видео YouTube.</li>
</ul>

<p>Вы можете управлять cookie через <a href="javascript:void(0)" onclick="openCookieSettings()">настройки cookie</a>.</p>

<h2>4. Хранение данных</h2>
<p>Данные хранятся столько, сколько необходимо для предоставления услуг или в рамках законодательства.</p>

<h2>5. Передача данных</h2>
<p>Данные могут передаваться третьим сторонам (например, аналитическим или рекламным поставщикам) только в соответствии с GDPR.</p>

<h2>6. Ваши права</h2>
<p>Согласно GDPR вы имеете право:</p>
<ul>
  <li>Получить доступ к своим данным</li>
  <li>Запросить исправление или удаление данных</li>
  <li>Возразить против обработки данных в определенных случаях</li>
</ul>

<h2>7. Контакты</h2>
<p>По вопросам конфиденциальности пишите: <a href="mailto:info@alginosnt.lt">info@alginosnt.lt</a></p>

</div>


@stop

