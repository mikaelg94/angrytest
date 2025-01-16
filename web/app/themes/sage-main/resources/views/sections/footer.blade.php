<footer class="bg-amber-50 py-10 mt-10">
  <div class="container">
    <div class="flex justify-between">
      @if (has_nav_menu('primary_navigation'))
        <div>
          <h3 class="uppercase tracking-wide mb-1 text-gray-600">Products</h3>
          <nav class="footer-nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
          </nav>
        </div>
      @endif

    </div>
    <ul class="text-gray-400 mt-10">
      <li>Norrgavel AB, 556491-3381, Elbegatan 3, 211 20 Malmö</li>
      <li>kundtjanst@norrgavel.se</li>
      <li>© 1991 - 2024 Copyright Norrgavel AB</li>
    </ul>
  </div>
</footer>
