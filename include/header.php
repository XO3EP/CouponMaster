<header>
    <div class="container px-5 py-1 d-flex justify-content-end">
        <?php if (UserActions::IsAuthorized()) : ?>
            <div>Вы авторизованы как <?= $_SESSION["USER_EMAIL"] ?>&nbsp; </div>
            <a href="/Project/pages/logout.php?returnPage=<?= urlencode($_SERVER["REQUEST_URI"]) ?>">Выйти</a>
        <?php else : ?>
            <a class="mx-3 header-text" href="/Project/pages/registration.php">Регистрация</a>
            <a class="mx-3 header-text" href="/Project/pages/login.php">Вход</a>
        <?php endif; ?>
    </div>
    <div class="container glav_cont">
      <div class="container text-center contacts glav_cont">
        <div class="row text-center glav_w">
          <div class="col pad_l-5">
            <a class="navbar-brand" href="/Project/">
              <img src="/Project/img/logo.png" alt="logo" />
            </a>
          </div>
          <div class="col">
            <div class="row flex-column">
              <b>ГОЛОВНОЙ ОФИС</b>
            </div>
            <div class="row flex-column">+7 (495) 663-99-38</div>
          </div>
          <div class="col">
            <div class="row flex-column"><b>МАГАЗИН ТРАКТ</b></div>
            <div class="row flex-column">+7 (495) 798-99-38</div>
          </div>
          <div class="col">
            <div class="row flex-column">
              <b class="krasnodar">ОФИС КРАСНОДАР</b>
            </div>
            <div class="row flex-column">+7 (861) 944-99-38</div>
          </div>
          <div class="col">
            <div class="row flex-column">
              <b class="piter">ОФИС САНКТ-ПЕТЕРБУРГ</b>
            </div>
            <div class="row flex-column">+7 (812) 953-90-05</div>
          </div>
          <div class="col pad_r-5">
            <button class="btn btn-warning krasnodar">
              <b>ЗАКАЗАТЬ ЗВОНОК</b>
            </button>
          </div>
        </div>
      </div>
      <div class="row text-center hat glav_w">
        <div class="col img_box">
          <img class="str" src="/Project/img/stp.png" alt="СТП" />
        </div>
        <div class="col info">
          <p class="str1">Официальный дистрибьютор</p>
          <p class="m-0">Costex Tractor Parts</p>
          <p class="m-0">Работаем с 2007 г.</p>
        </div>
        <div class="col text-center">
          <a href="#" class="btn btn_lil">
            <img src="/Project/img/vk.svg" class="btn_img" />
          </a>
          <a href="#" class="btn btn_lil">
            <img src="/Project/img/youtube.svg" alt="YouTube" class="btn_img" />
          </a>
        </div>
        <div class="col">
          <a href="/Project/pages/orders.php" class="btn btn_lil btn_shop"><b>ИНТЕРНЕТ МАГАЗИН</b></a>
        </div>
        <div class="col">
          <div class="input-group search_zip">
            <input
              type="search"
              class="form-control position-relative"
              placeholder="Search"
              aria-label="Search"
              aria-describedby="search-addon"
            />
            <button type="button " class="btn btn_search">
              <img
                src="/Project/img/search-svgrepo-com.svg"
                alt="Search"
                class="btn_img"
              />
            </button>
          </div>
        </div>
        <div class="col text-center">
          <a href="#" class="btn w-40 h-40">
            <img
              src="/Project/img/cart-svgrepo-com.svg"
              alt="Корзина"
              class="btn_img"
            />
            <p class="text-center w-60">Корзина</p>
          </a>
        </div>
      </div>
      <div class="container glav_cont">
        <nav class="navbar navbar-expand-lg navbar-light zip_color">
          <div class="container">
            <ul class="navbar-nav">
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Диллеры </a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">О компании </a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Запчасти </a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Сервис </a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Спецпредложения</a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Доставка </a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Новости </a>
              </li>
              <li class="nav-item active nav">
                <a class="nav-link text-black" href="#">Контакты </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
</header>