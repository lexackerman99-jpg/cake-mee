<div class="hero-slider-wrap">
  <div
    class="slider"
    style="--width: 200px;
      --height: 200px;
      --quantity: 9;"
  >
    <div class="list">
      @foreach(['01','02','03','04','05','06','07','08','10'] as $positionIndex => $photo)
        @php($position = $positionIndex + 1)
        <div class="item" style="--position: {{ $position }}">
          <div class="card">
            <img
              src="/images/produk/foto-{{ $photo }}.jpg"
              alt="Cake Mom Sitty {{ $position }}"
            >
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
